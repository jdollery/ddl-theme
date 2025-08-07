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
  /* FORMS */
  /*-----------------------------------------------------------------------------------*/

  jQuery('form').each(function() {

    const form = jQuery(this);

    /*-----------------------------------------------------------------------------------*/
    /* MAILCHIMP INPUT FILLER */
    /*-----------------------------------------------------------------------------------*/

    const subscribe = document.querySelector("#subscribe");

    if (subscribe) {

      const input = document.querySelectorAll('input');

      input.forEach((item) => {
        item.addEventListener('change', function() {
          const input_id = this.getAttribute('data-input');
          if (input_id) {
            const input_value = this.value;
            const output_id = document.getElementById(input_id);
            if (output_id) {
              output_id.value = input_value;
            }
          }
        });
      });

    }

    /*-----------------------------------------------------------------------------------*/
    /* VALIDATE */
    /*-----------------------------------------------------------------------------------*/

    const validobj = jQuery(this).validate({

      onkeyup: false,
      errorClass: "form__error",
      errorElement: 'strong',

      errorPlacement: function (error, event) {
        event.closest('.form__input').append(error);
      },

      highlight: function (element) {
        const event = jQuery(element);

        event.closest('.form__input').removeClass('form__input--success form__input--error').addClass('form__input--error');
        event.closest('.form__error').remove();

      },

      success: function (event) {
        event.closest('.form__input').removeClass('form__input--success form__input--error');
        event.closest('.form__error').remove();
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

    jQuery(this).on( "submit", function(event) {

      event.preventDefault();

      if (jQuery(this).valid()) {

        const type = form.data('form');

        form.find(".btn--submit").addClass("btn--sending");

        /*----------- Submit Functions & Variables -----------*/

        function securedentSubmit() {
          event.target.action = "https://www.securedent.net/submit.ashx";
        }

        const dengroSubmit = "XXXXXXXXXXXXXXX"; // Need whole url, e.g https://hooks.dengro.com/capture/XXXXXX-XXXX-XXXX-XXXX-XXXXXX

        function successSubmit() {
          event.target.submit();
          form.find('.btn--submit').removeClass('btn--sending');
        }

        function failedSubmit() {
          window.location.href = baseURL + "/sorry/"; 
          form.find('.btn--submit').removeClass('btn--sending');
        }

        /*----------- Google reCaptcha -----------*/
      
        grecaptcha.ready(function() {
          grecaptcha.execute(recaptchaKey, { action: "submit" }).then(function(token) { //variables located in header.php
      
            const recaptchaResponse = document.getElementById("recaptchaResponse")
            recaptchaResponse.value = token 
      
            const data = new FormData(event.target);

            /*----------- Google Fetch -----------*/
      
            fetch( baseURL + "/wp-content/themes/" + themeName + "/actions/validate.php", { //variables located in header.php
              method: 'post',
              body: data,
            })
      
            .then((response) => response.text())
            .then((response) => {
      
              const googleResponse = JSON.parse(response);

              /*----------- Google Response = Success -----------*/
              
              if (googleResponse.success) { 

                /*----------- Mailchimp Start -----------*/

                if (subscribe) {

                  if (subscribe.checked) {

                    fetch( baseURL + "/wp-content/themes/" + themeName + "/actions/mailchimp.php", { //variables located in header.php
                      method: 'post',
                      body: data,
                    })

                    .then((response) => response.text())
                    .then((response) => {
                      const chimpResponse = JSON.parse(response);

                      /*----------- Mailchimp Response = Success -----------*/

                      if (chimpResponse.success) {

                        if (type === 'dengro') {

                          /*----------- Dengro Fetch -----------*/

                          fetch(dengroSubmit, {  
                            method: 'post',
                            body: data,
                          })

                          .then((dengroResponse) => {

                            /*----------- Dengro Response -----------*/

                            if (dengroResponse.ok) {

                              successSubmit();
                            
                            } else {

                              failedSubmit();

                            }

                            event.target.reset();

                          })

                        } else {

                          /*----------- Securedent Submit -----------*/

                          securedentSubmit();
                          successSubmit();

                        }

                      /*----------- Mailchimp Response = Failed -----------*/
                      
                      } else {

                        failedSubmit();
                    
                      }

                    });

                  }

                }

                /*----------- Mailchimp Finish -----------*/

                if (type === 'dengro') {

                  /*----------- Dengro Fetch -----------*/

                  fetch(dengroSubmit, {  
                    method: 'post',
                    body: data,
                  })

                  .then((dengroResponse) => {

                    /*----------- Dengro Response -----------*/

                    if (dengroResponse.ok) {

                      successSubmit();
                    
                    } else {

                      failedSubmit();

                    }

                    event.target.reset();

                  })

                } else {

                  /*----------- Securedent Submit -----------*/

                  securedentSubmit();
                  successSubmit();

                }

              /*----------- Google Response = Failed -----------*/
      
              } else {

                failedSubmit();
      
                // console.log('reCAPTCHA error', responseText);
          
              }
      
            })

            /*----------- Submit Failed -----------*/
      
            .catch(error => {
      
              failedSubmit();

              // console.log('server side error');
      
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