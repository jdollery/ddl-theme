jQuery(document).ready(function () { //doc ready start

  /*-----------------------------------------------------------------------------------*/
  /* INIT SELECT2 */
  /*-----------------------------------------------------------------------------------*/

  jQuery('select').select2({
    minimumResultsForSearch: Infinity,
    placeholder: function(){
      jQuery(this).data('placeholder');
    }
  });


  /*-----------------------------------------------------------------------------------*/
  /* VALIDATION */
  /*-----------------------------------------------------------------------------------*/

  jQuery('form').each(function() {

    var validobj = jQuery(this).validate({

      onkeyup: false,
      errorClass: "form__error",
      errorElement: 'strong',

      errorPlacement: function (error, e) {
        e.closest('.form__input').append(error);
      },

      highlight: function (element) {
        var e = jQuery(element);

        e.closest('.form__input').removeClass('form__input--success form__input--error').addClass('form__input--error');
        e.closest('.form__error').remove();

      },

      success: function (e) {
        e.closest('.form__input').removeClass('form__input--success form__input--error');
        e.closest('.form__error').remove();
      }, rules:  {
        select: {required: true}
      }, messages: {
        select: {required: 'error'}
      },

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


    /*-----------------------------------------------------------------------------------*/
    /* SUBMIT WITH RECAPTCHA */
    /*-----------------------------------------------------------------------------------*/

    jQuery(this).on( "submit", function(e) {

      e.preventDefault();

      if (jQuery(this).valid()) {

        const form = jQuery(this);

        form.find(".btn--submit").addClass("btn--sending");
      
        grecaptcha.ready(function() {
          grecaptcha.execute(recaptchaKey, { action: "submit" }).then(function(token) {
      
            let recaptchaResponse = document.getElementById("recaptchaResponse")
            recaptchaResponse.value = token 
      
            const data = new FormData(e.target);
      
            fetch( baseURL + "/wp-content/themes/" + themeName + "/actions/validate.php", { //variables located in header.php
              method: 'post',
              body: data,
            })
      
            .then((response) => response.text())
            .then((response) => {

              function securedentSubmit() {
                e.target.action = "https://www.securedent.net/submit.ashx";
                e.target.submit();
                form.find('.btn--submit').removeClass('btn--sending');
              }
      
              const googleResponse = JSON.parse(response)
              
              if (googleResponse.success) { 

                securedentSubmit();
      
              } else {

                // form.find('.btn--submit').removeClass('btn--sending');

                window.location.href = baseURL + "/sorry/"; 
      
                // console.log('reCAPTCHA error', responseText);
          
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
/* SCROLL INPUT INTO VIEW ON FOCUS */
/*-----------------------------------------------------------------------------------*/

// window.onload = function () {

//   const forms = document.querySelectorAll('form');

//   if (forms) {

//     forms.forEach((e) => {

//       let inputs = e.querySelectorAll('input');

//       inputs.forEach((i) => {

//         i.addEventListener('click', function() {
//             i.scrollIntoView({
//               behavior: 'smooth',
//               block: "center"
//             });
//         });
        
//         i.addEventListener('touch', function() {
//             i.scrollIntoView({
//               behavior: 'smooth',
//               block: "center"
//             });
//         });

//       });

//     });

//   }

// }


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