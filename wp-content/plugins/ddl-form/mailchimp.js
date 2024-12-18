/*-----------------------------------------------------------------------------------*/
/* CONTACT FORM */
/*-----------------------------------------------------------------------------------*/

/*-------------------------- Reset form if browser navigates back/forward --------------------------*/

window.addEventListener("pageshow", () => {
  let formReset = document.querySelector("#chimpForm");
  if (formReset) {
    formReset.reset();
  }
});


jQuery(document).ready(function () {  

  /*-------------------------- Duplicates the value and adds it to another input --------------------------*/

  var input = jQuery('[data-input]');
  
  input.on('input', function () {
    
    var input_id = jQuery(this).attr('data-input');
    var input_value = jQuery(this).val();
    var output_id = jQuery('#' + input_id);
    
    output_id.val(input_value);
    
  });

  var select = jQuery('#offer');

  select.on('change', function() {

    var select_option = jQuery(this).find(':selected').val();
    var select_output = jQuery('#tag');

    select_output.val(select_option);

  });


  /*-------------------------- Initialise the validation object which will be called on form submit --------------------------*/

  var validChimpForm = jQuery(".form--chimp").validate({

    onkeyup: false,
    errorClass: "error",
    errorElement: 'strong',

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
    if (!jQuery.isEmptyObject(validChimpForm.submitted)) {
      validChimpForm.form();
    }
  });


  /*-------------------------- Base variables --------------------------*/

  var baseTheme = 'https://traceybell.co.uk/wp-content/themes/traceybell/';
  var baseURL = 'https://traceybell.co.uk/';


  /*-----------------------------------------------------------------------------------*/
  /* OFFER CONTACT FORM */
  /*-----------------------------------------------------------------------------------*/

  var subscribeForm = "#chimpForm";

  jQuery(subscribeForm).on( "submit", function(event) {

    event.preventDefault();

    if (jQuery(this).valid()) {

      let submitBtn = jQuery(this).find('.button--submit');

      submitBtn.addClass('button--sending');
    
      grecaptcha.ready(function() {

        grecaptcha.execute('6Ld60IEpAAAAAEwnY1kXCE3YaF0V9mqROOLc6PjC', {action: 'submit'}).then(function(token) {
    
          let recaptchaResponse = document.getElementById("recaptcha_response")
          recaptchaResponse.value = token 
    
          let data = new FormData(event.target);
    
          fetch( baseTheme + "validate-chimp.php", {
            method: 'post',
            body: data,
          })
    
          .then((response) => response.text())
          .then((response) => {
    
            const googleResponse = JSON.parse(response)
            
            if (googleResponse.success) { 

              // if(document.querySelector("#subscribe").checked) {

              fetch( baseTheme + "mailchimp.php", {
                method: 'post',
                body: data,
              })

              .then((response) => response.text())
              .then((response) => {
        
                const chimpResponse = JSON.parse(response)

                if (chimpResponse.success) { 

                  /*------ uncomment if testing ------*/

                  // console.log(chimpResponse);
                  // submitBtn.removeClass('button--sending');

                  // setTimeout(function() { 
                  //  submitBtn.removeClass('button--sending');
                  // }, 1000);


                  /*------ comment out if testing ------*/

                  document.querySelector(subscribeForm).submit();

                } else {

                  /*------ uncomment if testing ------*/

                  // console.log(chimpResponse);
                  // submitBtn.removeClass('button--sending'); 


                  /*------ comment out if testing ------*/

                  window.location.href = baseURL + "/sorry/"; 
            
                }

              })

              // } else {

              //   /*------ uncomment if testing ------*/

              //   // console.log(chimpResponse);
              //   // submitBtn.removeClass('button--sending'); 


              //   /*------ comment out if testing ------*/

              //   window.location.href = baseURL + "/sorry/"; 

              // }
    
            } else {

              /*------ uncomment if testing ------*/

              // console.log('reCAPTCHA error', googleResponse);
              // submitBtn.removeClass('button--sending'); 


              /*------ comment out if testing ------*/

              window.location.href = baseURL + "/sorry/"; 
        
            }
    
          })
    
          .catch(error => {

            /*------ uncomment if testing ------*/
    
            // console.log('server side error');
            // submitBtn.removeClass('button--sending'); 


            /*------ comment out if testing ------*/
            
            window.location.href = baseURL + "/sorry/";
    
          })
    
        })
    
      })

    }

  });

}); //doc ready end