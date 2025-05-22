window.onload = function () {

var forms = document.querySelectorAll('form');

forms.forEach((form) => {

  var type = form.getAttribute('data-form');

  var input = form.querySelectorAll('input');

  input.forEach((item) => {
    item.addEventListener('change', function() {
      var input_id = this.getAttribute('data-input');
      if (input_id) {
        var input_value = this.value;
        var output_id = document.getElementById(input_id);
        if (output_id) {
          output_id.value = input_value;
        }
      }
    });
  });

  var pristine = new Pristine(form);

  form.addEventListener('submit', function (event) {

    event.preventDefault();

    var valid = pristine.validate();

    if (valid) {

      event.preventDefault();

          form.querySelector('.btn--submit').classList.add('btn--sending');

          grecaptcha.ready(function() {

        grecaptcha.execute(recaptchaKey, { action: 'submit' }).then(function(token) { 

          let recaptchaResponse = form.querySelector("#recaptchaResponse");
          recaptchaResponse.value = token;

              let data = new FormData(event.target);

          fetch(baseURL + "/actions/validate.php", {
            method: 'post',
            body: data,
          })

          .then((response) => response.text())

          .then((response) => {

            const googleResponse = JSON.parse(response);

                if (googleResponse.success) {

              let subscribe = form.querySelector("#subscribe");

              if (subscribe) {

                if (subscribe.checked) {

                  fetch(baseURL + "/actions/mailchimp.php", {
                    method: 'post',
                    body: data,
                  })

                  .then((response) => response.text())

                  .then((response) => {
                    const chimpResponse = JSON.parse(response);

                          if (chimpResponse.success) {

                      if (type === 'dengro') {

                        fetch(event.target.action, {
                          method: 'post',
                          body: data,
                        })

                                  .then((response) => {

                          if (response.ok) {

                                      form.querySelector('.btn--submit').classList.remove('btn--sending');
                            form.submit();
                            window.location.href = baseURL + "/thanks.php"; 

                                    } else {

                                          window.location.href = baseUrl + "/sorry.php"; 

                                    }

                          event.target.reset();

                                  })

                            } else if (type === 'mailer') {

                              fetch(baseURL + "/actions/mailer.php", {
                          method: 'post',
                          body: data,
                        })

                              .then(response => response.json())
                        .then(data => {
                          if (data.message) {

                                  form.querySelector('.btn--submit').classList.remove('btn--sending');
                            form.submit();

                                  window.location.href = baseURL + "/thanks.php"; 
                          } else if (data.error) {

                                  window.location.href = baseUrl + "/sorry.php"; 
                          }
                        })
                        .catch(error => {

                                window.location.href = baseUrl + "/sorry.php"; 
                        });

                            } else {

                              form.querySelector('.btn--submit').classList.remove('btn--sending');
                        form.submit();

                            }

                    } else {

                      window.location.href = baseURL + "/sorry.php"; 
                    }

                  });

                }

                            } else {

                if (type === 'dengro') {

                  fetch(event.target.action, {
                    method: 'post',
                    body: data,
                  })

                      .then((response) => {

                    if (response.ok) {

                          form.querySelector('.btn--submit').classList.remove('btn--sending');
                      form.submit();
                      window.location.href = baseURL + "/thanks.php"; 

                        } else {

                              window.location.href = baseUrl + "/sorry.php"; 

                        }

                    event.target.reset();

                      })

                } else if (type === 'mailer') {

                        fetch(baseURL + "/actions/mailer.php", {
                    method: 'post',
                    body: data,
                  })

                  .then(response => response.json())
                  .then(data => {
                    if (data.message) {

                      form.querySelector('.btn--submit').classList.remove('btn--sending');
                      form.submit();

                      window.location.href = baseURL + "/thanks.php"; 
                    } else if (data.error) {

                      window.location.href = baseUrl + "/sorry.php"; 
                    }

                                      })
                  .catch(error => {

                    window.location.href = baseUrl + "/sorry.php"; 
                  });

                  event.target.reset();

                } else {

                  form.submit();
                  form.querySelector('.btn--submit').classList.remove('btn--sending');

                }

              }

            } else {

              window.location.href = baseURL + "/sorry.php"; 

            }

            event.target.reset();

          })

          .catch(error => {
            window.location.href = baseURL + "/sorry.php"; 
          });

        });

      });

    }

  }, false);

});

}