/*-----------------------------------------------------------------------------------*/
/* DIALOG OPEN ON CLICK */
/*-----------------------------------------------------------------------------------*/

// const ddlDialogs = document.querySelectorAll('[data-dialog]'),
//       ddlHtml = document.querySelector("html");

// ddlDialogs.forEach(function(trigger) {

//   trigger.addEventListener('click', function(event) {

//     event.preventDefault();

//     const dialog = document.getElementById(trigger.dataset.dialog);

//     dialog.classList.add('open');
//     ddlHtml.classList.add("dialog-visible");

//     const ddlDialogExits = dialog.querySelectorAll('[data-dialog-close]');

//     ddlDialogExits.forEach(function(exit) {

//       exit.addEventListener('click', function(event) {

//         event.preventDefault();

//         dialog.classList.remove('open');
//         ddlHtml.classList.remove("dialog-visible");

//       });

//     });

//   });

// });


/*-----------------------------------------------------------------------------------*/
/* DIALOG OPEN ON LOAD (ONLY SHOW ONCE) */
/*-----------------------------------------------------------------------------------*/

const initDDLDialog = function () {

  const dialog = document.getElementById("ddlDialog");

  if (dialog) {
    
    const root = document.documentElement;

    window.addEventListener("load", function() {

      if (dialog.classList.contains("ddl-dialog--session")) {
        
        const dialogShow = sessionStorage.getItem('ddlDialogSession');

        if (!dialogShow) {

          sessionStorage.setItem('ddlDialogSession', 'true');

          root.classList.add('ddl-dialog-visible');
          dialog.classList.add('ddl-dialog--visible');
          dialog.setAttribute('aria-modal', 'true');

        } else {

          sessionStorage.setItem('ddlDialogSession', 'false');

          root.classList.remove("ddl-dialog-visible");
          dialog.classList.remove('ddl-dialog--visible');
          dialog.setAttribute('aria-modal', 'false');

        }

      } else {
          
        sessionStorage.removeItem('ddlDialogSession');

        root.classList.add('ddl-dialog-visible');
        dialog.classList.add('ddl-dialog--visible');
        dialog.setAttribute('aria-modal', 'true');

      }
      
    });

    const ddlDialogExits = dialog.querySelectorAll('[data-dialog-close]');

    ddlDialogExits.forEach(function(exit) {

      exit.addEventListener('click', function(event) {

        event.preventDefault();

        if (dialog.classList.contains("ddl-dialog--session")) {

          sessionStorage.setItem('ddlDialogSession', 'false');

        }

        root.classList.remove("ddl-dialog-visible");
        dialog.classList.remove('ddl-dialog--visible');
        dialog.setAttribute('aria-modal', 'false');

      });

    });

  };

};

initDDLDialog();