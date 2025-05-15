const styles = [
  'color: #006875',
  'border: 1px solid #006875',
  'padding: 10px 15px',
  'border-radius: 5px;'
].join(';');

console.info('%cCreated by Dental Design - https://dental-design.marketing/', styles);


/*-----------------------------------------------------------------------------------*/
/* FORCE PAGE RELOAD TO STOP SAFARI & EDGE PAGE CHACHE */
/*-----------------------------------------------------------------------------------*/

window.onpageshow = function(event) {
  if (event.persisted) {
    window.location.reload()
  }
};


/*-----------------------------------------------------------------------------------*/
/* HEADER RESIZE VARIABLE */
/*-----------------------------------------------------------------------------------*/

let headerSize = document.querySelector('.header');

let headerLoad = headerSize.offsetHeight;
document.body.style.setProperty('--header-height', `${headerLoad}px`);
document.body.style.setProperty('--vh', (window.innerHeight*.01) + 'px');

window.onresize = function(event) {

  let headerResize = headerSize.offsetHeight;
  document.body.style.setProperty('--header-height', `${headerResize}px`);
  document.body.style.setProperty('--vh', (window.innerHeight*.01) + 'px'); //mob/tablet window height fix

};


/*-----------------------------------------------------------------------------------*/
/* STICKY NAV */
/*-----------------------------------------------------------------------------------*/

let header = document.querySelector('.header');

function headerSticky(){

  if (window.scrollY > 250) {
    header.classList.add('header--sticky');
  } else {
    header.classList.remove('header--sticky');
  }

}

document.addEventListener('DOMContentLoaded', ()=>{
  document.addEventListener('scroll', headerSticky); 
  headerSticky();
});


/*-----------------------------------------------------------------------------------*/
/* RESPONSIVE NAV */
/*-----------------------------------------------------------------------------------*/

let navChild = document.querySelector('.navigation li li');

if (navChild) {
  let navParent = navChild.closest('ul');
  navParent.classList.add("sub-menu");
}

// let navSub = navChild.parentElement();
// navSub.classList.add("menu-item-has-childrens");

// var customToggle = document.getElementById('navToggle');

var nav = responsiveNav("#headerNav", {
  customToggle: "#navToggle", // Selector: Specify the ID of a custom toggle
  enableFocus: true,
  enableDropdown: true,
  openDropdown: '<span class="hidden">Open sub menu</span>',
  closeDropdown: '<span class="hidden">Close sub menu</span>',

  // open: function () {
  //   // if (customToggle.getAttribute('aria-expanded') === 'false') {
  //     customToggle.setAttribute( 'aria-expanded', 'true' );
  //   // }
  // },

  // close: function () {
  //   // if (customToggle.getAttribute('aria-expanded') === 'true') {
  //     customToggle.setAttribute( 'aria-expanded', 'false' );
  //   // }
  // },
  
  // open: function () {
  //   customToggle.innerHTML = '<div class="burger__inner"><div class="burger__trigger"><span class="burger__icon"></span></div><div class="burger__text">Close</div></div>';
  // },
  // close: function () {
  //   customToggle.innerHTML = '<div class="burger__inner"><div class="burger__trigger"><span class="burger__icon"></span></div><div class="burger__text">Menu</div></div>';
  // },
  
  // resizeMobile: function () {
  //   customToggle.setAttribute( 'aria-controls', 'headerNav' );
  // },
  
  // resizeDesktop: function () {
  //   customToggle.removeAttribute( 'aria-controls' );
  // },
  
});

var close = document.getElementById("viewOverlay");
close.addEventListener("click", function () {
  nav.close();
}, false);


jQuery(document).ready(function () { //doc ready start

  /*-----------------------------------------------------------------------------------*/
  /* SLICK SLIDER */
  /*-----------------------------------------------------------------------------------*/

    // jQuery('#testimonialSlider').slick({
    //   slidesToShow: 1,
    //   slidesToScroll: 1,
    //   centerMode: true,
    //   autoplay: true,
    //   autoplaySpeed: 3000,
    //   fade: true,
    //   swipe: false,
    //   pauseOnHover: false,
    //   pauseOnFocus: false,
    //   focusOnSelect: true,
    //   dots: false,
    //    arrows: true,
    //    prevArrow: jQuery('#arrowPrev'),
    //    nextArrow: jQuery('#arrowNext'),
    //   rows: 0 // Fix to remove extra div v1.8.0-1
    // });


  /*-----------------------------------------------------------------------------------*/
  /* CONTACT FORM */
  /*-----------------------------------------------------------------------------------*/

  jQuery('select').select2({
    minimumResultsForSearch: Infinity,
    placeholder: function(){
      jQuery(this).data('placeholder');
    }
  });

  jQuery('form').each(function() {

    var validobj = jQuery(this).validate({

      onkeyup: false,
      errorClass: "error",
      errorElement: 'strong',

      // errorPlacement: function (error, element) {
      //   var elem = jQuery(element);
      //   error.insertAfter(element);
      // },

      highlight: function (element, errorClass, validClass) {
        var elem = jQuery(element);
        if (elem.hasClass("select2-hidden-accessible")) {
          jQuery(".select2-container").addClass(errorClass);
        } else {
          elem.addClass(errorClass);
        }
      },

      unhighlight: function (element, errorClass, validClass) {
        var elem = jQuery(element);
        if (elem.hasClass("select2-hidden-accessible")) {
          jQuery(".select2-container").removeClass(errorClass);
        } else {
          elem.removeClass(errorClass);
        }
      }

    });

    jQuery(document).on("change", ".select2-hidden-accessible", function () {
      if (!jQuery.isEmptyObject(validobj.submitted)) {
        validobj.form();
      }
    });

    jQuery(document).on("select2-opening", function () {
      if (jQuery(".select2-container").hasClass("error")) {
        jQuery(".select2-drop ul").addClass("error");
      } else {
        jQuery(".select2-drop ul").removeClass("error");
      }
    });

    jQuery.validator.addMethod('filesize', function(value, element, param) {
      return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than 5mb');

    jQuery(this).on( "submit", function(e) {

      e.preventDefault();

      if (jQuery(this).valid()) {

        jQuery(this).find('.btn--submit').addClass('btn--sending');
      
        grecaptcha.ready(function() {
          grecaptcha.execute('XXXXXXXXXXXX', {action: 'submit'}).then(function(token) {
      
            let recaptchaResponse = document.getElementById("recaptcha_response")
            recaptchaResponse.value = token 
      
            const data = new FormData(e.target);
      
            fetch( "https://XXXXXXXXX/wp-content/themes/XXXXXXXXX/validate.php", {
              method: 'post',
              body: data,
            })
      
            .then((response) => response.text())
            .then((response) => {
      
              const responseText = JSON.parse(response)
              
              if (responseText.success) { 

                jQuery(this).find('.btn--submit').removeClass('btn--sending');

                jQuery(this).submit()
      
              } else {

                jQuery(this).find('.btn--submit').removeClass('btn--sending');
      
                console.log('reCAPTCHA error', responseText);
          
              }
      
            })
      
            .catch(error => {
      
              console.log('server side error');
      
            })
      
          })
      
        })

      }

    });

  });

}); //doc ready end


/*-----------------------------------------------------------------------------------*/
/* TEAM */
/*-----------------------------------------------------------------------------------*/

/*----------- Control slideout on team page -----------*/

const members = document.querySelectorAll('.member');

if (members) {

  let html = document.querySelector("html");
  let open = document.querySelectorAll('[data-open]');

  open.forEach((e) => {
    
    e.addEventListener('click', function() {
      
      let id = this.dataset.open;
      let sideout = document.querySelector('[data-sideout="' + id + '"]');

      if (!sideout.classList.contains('slideout--open')) {
        sideout.classList.add('slideout--open');
        html.classList.add("js-slideout-active");

        open.forEach((i) => {
          if (i.dataset.open == id) {
            i.setAttribute( 'aria-expanded', 'true' );
          }
        });

      }

    });

  });

  var close = document.querySelectorAll('[data-close]');

  close.forEach((e) => {
    
    e.addEventListener('click', function() {
      
      let id = this.dataset.close;
      let sideout = document.querySelector('[data-sideout="' + id + '"]');
      
      if (sideout.classList.contains('slideout--open')) {
        sideout.classList.remove('slideout--open');
        html.classList.remove("js-slideout-active");

        open.forEach((i) => {
          if (i.dataset.open == id) {
            i.setAttribute( 'aria-expanded', 'false' );
          }
        });

      }

    });

  });

}


/*----------- Open slideout with hash -----------*/

if(window.location.href.indexOf('team') != -1) {

  let name = location.hash;
  let slug = name.replace('#','');
  let sideout = document.querySelector('[data-sideout="' + slug + '"]');
  let html = document.querySelector("html");

  if (sideout && !sideout.classList.contains('slideout--open')) {   
    
    let member = document.getElementById(slug);

    member.scrollIntoView({
      behavior: 'smooth'
    });

    setTimeout(function(){
      sideout.classList.add('slideout--open');
      html.classList.add("js-slideout-active");

      let open = document.querySelectorAll('[data-open="' + slug + '"]');

      open.forEach((i) => {
        i.setAttribute('aria-expanded', 'true');      
      });

    }, 1000);


  }

}

const links = document.querySelectorAll('a');

links.forEach((e) => {
  if (e.href && e.href.includes("/team/")) {
    e.addEventListener('click', function(event) {
      event.preventDefault();
      window.open(this.href, '_self');
    });
  }
});


/*----------- Scroll to data anchor -----------*/

// const anchors = document.querySelectorAll('[data-anchor]');

// anchors.forEach(function(anchor) {

//   anchor.addEventListener('click', function() {  

//     let target = anchor.dataset.anchor;
//     let id = document.getElementById(target);

//     if(window.location.href.indexOf('team') != -1) {

//       let controls = document.querySelector('.team__navigation');
//       let height = controls.offsetHeight;

//       window.scrollTo({
//         top: id.offsetTop - height, 
//         behavior: "smooth"
//       });

//     } else {

//       id.scrollIntoView({
//         behavior: 'smooth'
//       });

//       // window.scrollTo({
//       //   top: id, 
//       //   behavior: "smooth"
//       // });

//     }

//   });

// });


/*-----------------------------------------------------------------------------------*/
/* ACCORDION */
/*-----------------------------------------------------------------------------------*/

let slideUp = (target, duration = 500) => {
  target.style.transitionProperty = 'height, margin, padding';
  target.style.transitionDuration = duration + 'ms';
  target.style.height = target.scrollHeight + 'px';
  target.offsetHeight;
  target.style.overflow = 'hidden';
  target.style.height = 0;
  target.style.paddingTop = 0;
  target.style.paddingBottom = 0;
  target.style.marginTop = 0;
  target.style.marginBottom = 0;
  window.setTimeout( () => {
    target.style.display = 'none';
    target.style.removeProperty('height');
    target.style.removeProperty('padding-top');
    target.style.removeProperty('padding-bottom');
    target.style.removeProperty('margin-top');
    target.style.removeProperty('margin-bottom');
    target.style.removeProperty('overflow');
    target.style.removeProperty('transition-duration');
    target.style.removeProperty('transition-property');
  }, duration);
}

let slideDown = (target, duration = 500) => {
  target.style.removeProperty('display');
  let display = window.getComputedStyle(target).display;

  if (display === 'none')
    display = 'block';

  target.style.display = display;
  let height = target.scrollHeight;
  target.style.overflow = 'hidden';
  target.style.height = 0;
  target.style.paddingTop = 0;
  target.style.paddingBottom = 0;
  target.style.marginTop = 0;
  target.style.marginBottom = 0;
  target.offsetHeight;
  target.style.transitionProperty = "height, margin, padding";
  target.style.transitionDuration = duration + 'ms';
  target.style.height = height + 'px';
  target.style.removeProperty('padding-top');
  target.style.removeProperty('padding-bottom');
  target.style.removeProperty('margin-top');
  target.style.removeProperty('margin-bottom');
  window.setTimeout( () => {
    target.style.removeProperty('height');
    target.style.removeProperty('overflow');
    target.style.removeProperty('transition-duration');
    target.style.removeProperty('transition-property');
  }, duration);
}

var slideToggle = (target, duration = 500) => {
  if (window.getComputedStyle(target).display === 'none') {
    return slideDown(target, duration);
  } else {
    return slideUp(target, duration);
  }
}

var dropDowns = document.querySelectorAll("#accordionItem")

dropDowns.forEach((dropDown) => {
  
  dropDown.addEventListener('click', function() {

    /*----------- Open/Close each -----------*/

    // slideToggle(dropDown.nextElementSibling, 500);

    // var toggle = dropDown.querySelector('button');
    
    // if (dropDown.classList.contains('accordion__item--open')) {
    //   dropDown.classList.remove('accordion__item--open');
    //   toggle.setAttribute( 'aria-expanded', 'false' );
    // }
    // else {
    //   dropDown.classList.add('accordion__item--open');
    //   toggle.setAttribute( 'aria-expanded', 'true' );
    // }

    /*----------- Open/Close one at a time -----------*/

    var openDropDowns = document.querySelectorAll(".accordion__item--open");
    var toggle = dropDown.querySelector('button');
    
    if (dropDown.classList.contains('accordion__item--open')) {
      dropDown.classList.remove('accordion__item--open');
      toggle.setAttribute( 'aria-expanded', 'false' );
      slideUp(dropDown.nextElementSibling, 500);
    }
    else {
      openDropDowns.forEach((open) => {
        open.classList.remove('accordion__item--open');
        slideUp(open.nextElementSibling, 500);
      });
      dropDown.classList.add('accordion__item--open');
      slideDown(dropDown.nextElementSibling, 500);
      toggle.setAttribute( 'aria-expanded', 'true' );
    }

  });
  
});


/*-----------------------------------------------------------------------------------*/
/* CUSTOM FILE UPLOAD */
/*-----------------------------------------------------------------------------------*/

const inputs = document.querySelectorAll( '.upload' );

inputs.forEach(function(input) {

  let label	 = input.nextElementSibling;
  let labelVal = label.innerHTML;

  input.addEventListener( 'change', function(e){

    let fileName = '';

    if( this.files && this.files.length > 1 ) {
      fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
    } else {
      fileName = e.target.value.split( '\\' ).pop();
    }

    if( fileName ) {
      label.querySelector( '.upload__file' ).innerHTML = fileName;
      // console.log(fileName);
    } else {
      label.innerHTML = labelVal;
      // console.log(labelVal);
    }
  });

  // Firefox bug fix
  input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
  input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });

});


inputs.forEach(function(input) {

  let label	 = input.nextElementSibling;
  // console.log(label)

});


/*-----------------------------------------------------------------------------------*/
/* SCROLL TO ANCHOR */
/*-----------------------------------------------------------------------------------*/

// https://stackoverflow.com/questions/7717527/smooth-scrolling-when-clicking-an-anchor-link

jQuery('a[href*="#"]')
// Remove links that don't actually link to anything
.not('[href="#"]')
.not('[href="#0"]')
.click(function(event) {
  // On-page links
  if (
    location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
    && 
    location.hostname == this.hostname
  ) {
    // Figure out element to scroll to
    var target = jQuery(this.hash);
    target = target.length ? target : jQuery('[name=' + this.hash.slice(1) + ']');
    // Does a scroll target exist?
    if (target.length) {
      // Only prevent default if animation is actually gonna happen
      event.preventDefault();

      jQuery('html, body').animate({
        scrollTop: target.offset().top-165
      }, 1000, function() {
        // Callback after animation
        // Must change focus!
        var $target = jQuery(target);
        $target.focus();
        if ($target.is(":focus")) { // Checking if the target was focused
          return false;
        } else {
          $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
          $target.focus(); // Set focus again
        };
      });

    }
  }
  return false;
});


/*-----------------------------------------------------------------------------------*/
/* INIT WOW */
/*-----------------------------------------------------------------------------------*/

// function afterReveal (element) {
// 	if (element.classList.contains('trigger')) {
// 		element.addEventListener('animationend', function () {
// 			console.log('This runs once finished!');
//       // element.style.opacity ='1';
// 		});
// 	}
// }

// wow = new WOW(
//   {
//     boxClass: 'wow',
//     animateClass: 'animated',
//     offset: 0,
//     mobile: true,
//     live: true,
//     // callback: afterReveal
//   }
// )
// wow.init();


/*-----------------------------------------------------------------------------------*/
/* VIDEO DIALOG */
/*-----------------------------------------------------------------------------------*/

document.querySelectorAll("#videoToggle").forEach((d) => d.addEventListener("click", playVideos));

const html = document.querySelector("html");

function playVideos(e) {

  videoDialog(e.currentTarget.dataset.url);

  html.classList.add("js-dialog-active");

  var videoWrap = document.createElement("DIV");
  videoWrap.setAttribute("id", "videoWrap");
  videoWrap.setAttribute("class", "dialog");
  videoWrap.setAttribute("aria-modal", "false");
  document.body.appendChild(videoWrap);

  const wrapper = document.getElementById("videoWrap");

  window.setTimeout(function(){
    wrapper.classList.add("dialog--active");
    wrapper.setAttribute("aria-modal", "true");
  }, 10);

  const url = this.dataset.url;

  const startModal = '<span onclick="videoDialogClose();" class="dialog__overlay" aria-label="Close dialog"></span> <div class="dialog__inner">';
  const finishModal = '<button onclick="videoDialogClose();" class="dialog__close"><span class="hidden">Close</span></button></div>';
  
  if (url.indexOf("mp4") !== -1 || url.indexOf("m4v") !== -1) {
    
    document.getElementById(
      "videoWrap"
    ).innerHTML = `${startModal}<video controls loop playsinline autoplay><source src='${this.dataset.url}' type="video/mp4"></video>${finishModal}`;
  } else {
    alert("No video link found.");
  }

}

const videoDialogClose = () => {
  html.classList.remove("js-dialog-active");

  const wrapper = document.getElementById("videoWrap");
  wrapper.parentNode.removeChild(wrapper);

};


function videoDialog(){}


/*-----------------------------------------------------------------------------------*/
/* TREATMENT SELECT */
/*-----------------------------------------------------------------------------------*/

// document.querySelectorAll("[name=test_redirect]")[0].addEventListener('change', function () {
//   window.location = "https://www.bbc.co.uk/" + this.value;
// });

// let selectList = null;
// let listButton = null;

// let treatmentSelect = document.getElementById("treatmentSelect");

// if (treatmentSelect) {

//   window.addEventListener("DOMContentLoaded", getElements);

//   function getElements(e){
//     selectList = document.getElementById("treatmentSelect");
//     listButton = document.getElementById("treatmentButton");
//     listButton.addEventListener("click", clickHandler);
//   }

//   function clickHandler(e){
//     if(selectList.value!="select"){
//       var win = window.open(selectList.value,"_top");
//     } else {
//       alert("Chose between the three options!");
//     }
//   }

// }


/* ---- Example ---- */

/* <select 
  id="treatmentSelect" 
  name="specialist_treatment" 
  data-placeholder="Choose a specialist treatment" 
  >
  <option></option>
  <option label="Emergency dentistry" value="<?php echo get_the_permalink( 66 ) ?>">Emergency dentistry</option>
  <option label="Dental implants" value="<?php echo get_the_permalink( 432 ) ?>">Dental implants</option>
  <option label="Invisalign treatment" value="<?php echo get_the_permalink( 118 ) ?>">Invisalign treatment</option>
  <option label="Root canal treatment" value="<?php echo get_the_permalink( 119 ) ?>">Root canal treatment</option>
  <option label="Cosmetic dentistry" value="<?php echo get_the_permalink( 120 ) ?>">Cosmetic dentistry</option>
</select>

<button class="btn btn--yellow btn--sm" id="treatmentButton">Go!</button> */


/*-----------------------------------------------------------------------------------*/
/* DIALOGS */
/*-----------------------------------------------------------------------------------*/

// const dialogs = document.querySelectorAll('[data-dialog]');

// dialogs.forEach(function(trigger) {

//   trigger.addEventListener('click', function(event) {

//     event.preventDefault();

//     const dialog = document.getElementById(trigger.dataset.dialog);

//     dialog.classList.add('dialog--active');
//     html.classList.add("js-dialog-active");
//     const exits = dialog.querySelectorAll('#dialogClose');

//     exits.forEach(function(exit) {

//       exit.addEventListener('click', function(event) {

//         event.preventDefault();
//         dialog.classList.remove('dialog--active');
//         html.classList.remove("js-dialog-active");

//       });

//     });

//   });

// });


/* ---- SHOW ONLY PER SESSION ---- */

// var dialogVisable = document.getElementById("dialog");

// if (dialogVisable) {

//   // window.onload = function () {
//   window.addEventListener("load", function() {

//     var dialog = document.getElementById("dialog");
//     var root = document.getElementsByTagName( 'html' )[0];

//     var show_dialog = sessionStorage.getItem('dialogShown');

//     if (show_dialog != 'true') {

//       sessionStorage.setItem('dialogShown', 'true');

//       root.classList.add('js-dialog-active');
//       dialog.classList.add('dialog--active');

//       // console.log(show_dialog);

//     } else {

//       sessionStorage.setItem('shown-dialog', 'false');

//       root.classList.remove("js-dialog-active");
//       dialog.classList.remove('dialog--active');

//       // console.log(show_dialog);

//     }

//     const exits = dialog.querySelectorAll('#dialogClose');

//     exits.forEach(function(exit) {

//       exit.addEventListener('click', function(event) {

//         sessionStorage.setItem("modal", "none");
//         dialog.classList.remove('dialog--active');
//         root.classList.remove("js-dialog-active");

//       });

//     });

//   }, 500);

// };


/*-----------------------------------------------------------------------------------*/
/* OPENING TIMES */
/*-----------------------------------------------------------------------------------*/

/* <span id="openingTimes"></span> */

// let opening = document.getElementById("openingTimes");
// let d = new Date();
// let n = d.getDay();
// let now = d.getHours() * 60 + d.getMinutes(); // Convert current time to minutes since midnight
// let weekdays = [
//   ["Sunday"],
//   ["Monday", 9 * 60, 17 * 60], // Convert opening and closing times to minutes since midnight
//   ["Tuesday", 9 * 60, 17 * 60],
//   ["Wednesday"],
//   ["Thursday", 9 * 60, 17 * 60],
//   ["Friday", 9 * 60, 17 * 60],
//   ["Saturday"]
// ];
// let day = weekdays[n];

// if (now >= day[1] && now < day[2]) { // Use >= instead of >
//   opening.innerHTML = 'Open today: ' + formatTime(day[1]) + ' - ' + formatTime(day[2]); // Utilize formatTime function to format time
// }
// else {
//   opening.innerHTML = "Sorry we&rsquo;re closed: <span>opening hours</span>";
// }

// function formatTime(minutes) {
//   let hours = Math.floor(minutes / 60);
//   let mins = minutes % 60;
//   return pad(hours) + ':' + pad(mins);
// }

// function pad(value) {
//   return value.toString().padStart(2, '0');
// }