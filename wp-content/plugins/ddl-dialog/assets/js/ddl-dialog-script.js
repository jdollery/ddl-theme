/*-----------------------------------------------------------------------------------*/
/* DIALOG OPEN ON CLICK */
/*-----------------------------------------------------------------------------------*/

const dialogs = document.querySelectorAll('[data-dialog]'),
      html = document.querySelector("html");

dialogs.forEach(function(trigger) {

  trigger.addEventListener('click', function(event) {

    event.preventDefault();

    const dialog = document.getElementById(trigger.dataset.dialog);

    dialog.classList.add('open');
    html.classList.add("dialog-active");

    const exits = dialog.querySelectorAll('[data-dialog-close]');

    exits.forEach(function(exit) {

      exit.addEventListener('click', function(event) {

        event.preventDefault();

        dialog.classList.remove('open');
        html.classList.remove("dialog-active");

      });

    });

  });

});


/*-----------------------------------------------------------------------------------*/
/* DIALOG OPEN ON LOAD (ONLY SHOW ONCE) */
/*-----------------------------------------------------------------------------------*/

var dialogVisable = document.getElementById("dialog");

if (dialogVisable) {

  // window.onload = function () {
  window.addEventListener("load", function() {

    var dialog = document.getElementById("dialog");
    var root = document.getElementsByTagName( 'html' )[0];

    var show_dialog = sessionStorage.getItem('dialogShown');

    if (show_dialog != 'true') {

      sessionStorage.setItem('dialogShown', 'true');

      root.classList.add('js-dialog-active');
      dialog.classList.add('active');

      console.log(show_dialog);

    } else {

      sessionStorage.setItem('shown-dialog', 'false');

      root.classList.remove("js-dialog-active");
      dialog.classList.remove('active');

      console.log(show_dialog);

    }
    
    document.getElementById("dialogClose").onclick = function () {
      dialog.classList.remove('active');
      sessionStorage.setItem("modal", "none");
      root.classList.remove("js-dialog-active");
    };
    
  }, 500);

};