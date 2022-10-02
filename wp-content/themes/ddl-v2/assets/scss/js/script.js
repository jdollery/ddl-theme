const styles = [
  'color: white',
  'background: #1171ae',
  'padding: 10px 15px',
].join(';');

console.info('%cSite designed and developed by Dental Design - dental-design.marketing', styles);


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
  /* SLICK SLIDER */
  /*-----------------------------------------------------------------------------------*/

    jQuery('#testimonialSlider').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      centerMode: true,
      autoplay: true,
      autoplaySpeed: 3000,
      fade: true,
      swipe: false,
      pauseOnHover: false,
      pauseOnFocus: false,
      focusOnSelect: true,
      arrows: false,
      rows: 0 // Fix to remove extra div v1.8.0-1
    });

    
  /*-----------------------------------------------------------------------------------*/
  /* ACCORDION */
  /*-----------------------------------------------------------------------------------*/

  jQuery("#dropItem > dt").on("click", function() {
    if (jQuery(this).hasClass("active")) {
      jQuery(this).removeClass("active");
      jQuery(this).siblings("dd").slideUp(200);
    } else {
      jQuery("#dropItem > dt").removeClass("active");
      jQuery(this).addClass("active");
      jQuery("dd").slideUp(200);
      jQuery(this).siblings("dd").slideDown(200);
    }
  });


  /*-----------------------------------------------------------------------------------*/
  /* CONTACT FORM */
  /*-----------------------------------------------------------------------------------*/

  jQuery('select').select2({
    minimumResultsForSearch: Infinity,
    placeholder: function(){
      jQuery(this).data('placeholder');
    }
  });


}); //doc ready end


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

function afterReveal (element) {
	if (element.classList.contains('trigger')) {
		element.addEventListener('animationend', function () {
			console.log('This runs once finished!');
      // element.style.opacity ='1';
		});
	}
}

wow = new WOW(
  {
    boxClass: 'wow',      // default
    animateClass: 'animated', // default
    offset: 0,          // default
    mobile: true,       // default
    live: true,        // default
    callback: afterReveal
  }
)
wow.init();