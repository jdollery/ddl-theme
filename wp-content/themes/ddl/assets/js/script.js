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
    setHeaderColour();
    jQuery(window).scroll(setHeaderColour);
  });

  function setHeaderColour() {
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

  var navigation = responsiveNav("#headerNav", {
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


}); //doc ready end