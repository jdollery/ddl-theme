console.info('%cSite designed and developed by Dental Design - https://dental-design.marketing', 'color: black' );

/*-----------------------------------------------------------------------------------*/
/* FORCE PAGE RELOAD TO STOP SAFARI & EDGE PAGE CHACHE */
/*-----------------------------------------------------------------------------------*/

window.onpageshow = function(event) {
  if (event.persisted) {
    window.location.reload()
  }
};


jQuery(document).ready(function () { //doc ready start

  /*-----------------------------------------------------------------------------------*/
  /* STICKY NAV */
  /*-----------------------------------------------------------------------------------*/

  jQuery(function(){
    setSticky();
    jQuery(window).scroll(setSticky);
  });

  function setSticky() {
    if (jQuery(window).scrollTop() > 1) {
      jQuery('#mainHeader').addClass("sticky");
    }
    else{
      jQuery('#mainHeader').removeClass("sticky");
    }
  }


  /*-----------------------------------------------------------------------------------*/
  /* RESPONSIVE NAV */
  /*-----------------------------------------------------------------------------------*/

  jQuery('.navigation li').parent().find("ul").addClass('sub-menu');
  jQuery('.sub-menu').parent().addClass('menu-item-has-children');

  var customToggle = document.getElementById('navToggle');

  var nav = responsiveNav("#headerNav", {
    customToggle: "#navToggle", // Selector: Specify the ID of a custom toggle
    enableFocus: true,
    enableDropdown: true,
    openDropdown: '<span class="hidden">Open sub menu</span>',
    closeDropdown: '<span class="hidden">Close sub menu</span>',
    // open: function () {
    //     customToggle.innerHTML = '<div class="burger__inner"></div><span class="hidden">Close menu</span>';
    // },
    // close: function () {
    //     customToggle.innerHTML = '<div class="burger__inner"></div><span class="hidden">Open menu</span>';
    // },
    
    resizeMobile: function () {
      customToggle.setAttribute( 'aria-controls', 'headerNav' );
    },
    
    resizeDesktop: function () {
      customToggle.removeAttribute( 'aria-controls' );
    },
    
  });

  var close = document.getElementById("viewOverlay");
  close.addEventListener("click", function (e) {
    e.preventDefault();
    nav.close();
  }, false);


/*-----------------------------------------------------------------------------------*/
/* SLICK SLIDER */
/*-----------------------------------------------------------------------------------*/

  jQuery('#homeCarousel').slick({
    dots: false,
    // arrows: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    rows: 0 // Fix to remove extra div v1.8.0-1
  });

  /*-----------------------------------------------------------------------------------*/
  /* CONTACT FORM */
  /*-----------------------------------------------------------------------------------*/

  // jQuery('select').select2({
  //   minimumResultsForSearch: Infinity,
  //   placeholder: function(){
  //     jQuery(this).data('placeholder');
  //   }
  // });

  // //Initialize the validation object which will be called on form submit.
  // var validobj = jQuery("#validateForm").validate({
  //   onkeyup: false,
  //   errorClass: "error",
  //   errorElement: 'strong',

  //   errorPlacement: function (error, element) {
  //     var elem = jQuery(element);
  //     error.insertAfter(element);
  //   },

  //   highlight: function (element, errorClass, validClass) {
  //     var elem = jQuery(element);
  //     if (elem.hasClass("select2-hidden-accessible")) {
  //       jQuery(".select2-container").addClass(errorClass);
  //     } else {
  //       elem.addClass(errorClass);
  //     }
  //   },

  //   unhighlight: function (element, errorClass, validClass) {
  //       var elem = jQuery(element);
  //       if (elem.hasClass("select2-hidden-accessible")) {
  //         jQuery(".select2-container").removeClass(errorClass);
  //       } else {
  //         elem.removeClass(errorClass);
  //       }
  //   }
  // });

  // jQuery(document).on("change", ".select2-hidden-accessible", function () {
  //   if (!jQuery.isEmptyObject(validobj.submitted)) {
  //     validobj.form();
  //   }
  // });

  // jQuery(document).on("select2-opening", function () {
  //   if (jQuery(".select2-container").hasClass("error")) {
  //     jQuery(".select2-drop ul").addClass("error");
  //   } else {
  //     jQuery(".select2-drop ul").removeClass("error");
  //   }
  // });

  
  /*-----------------------------------------------------------------------------------*/
  /* SOCIAL SWITCHER */
  /*-----------------------------------------------------------------------------------*/

  // jQuery('#tabToggle li').click(function(){
	// 	var tab_id = jQuery(this).attr('data-tab');

	// 	jQuery('#tabToggle li').removeClass('current');
	// 	jQuery('.feed__region').removeClass('current');

	// 	jQuery(this).addClass('current');
	// 	jQuery("#"+tab_id).addClass('current');
  // })


}); //doc ready end