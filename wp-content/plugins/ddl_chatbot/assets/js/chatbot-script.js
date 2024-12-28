/*-----------------------------------------------------------------------------------*/
/* CHATBOT TRIGGER */
/*-----------------------------------------------------------------------------------*/

let openChat = document.querySelector('#chatToggle');

if (openChat) {

  let chatDialog = document.querySelector('#chatDialog');
  let chatParent = chatDialog.parentElement;
  let chatTxt = openChat.querySelector('.chatbot__txt');

  let chatBot = chatDialog.querySelector('iframe');
  let chatData = chatBot.getAttribute('data-src');

  function chatToggle() {

    if (chatDialog.classList.contains('chatbot__dialog--open')) {

      chatDialog.classList.remove('chatbot__dialog--open');
      chatDialog.classList.add('chatbot__dialog--closed');
      chatDialog.setAttribute('aria-hidden', true);
      
      openChat.classList.remove('chatbot__btn--open');
      openChat.classList.add('chatbot__btn--closed');
      openChat.setAttribute('aria-expanded', false);

      chatTxt.innerHTML="Open chat";

    } else {

      chatDialog.classList.remove('chatbot__dialog--closed');
      chatDialog.classList.add('chatbot__dialog--open');
      chatDialog.setAttribute('aria-hidden', false);

      openChat.classList.remove('chatbot__btn--closed');
      openChat.classList.add('chatbot__btn--open');
      openChat.setAttribute('aria-expanded', true);

      chatTxt.innerHTML="Close chat";

    }

  }


  if (chatParent.classList.contains('chatbot--onload')) {

    /*-----------------------------------------------------------------------------------*/
    /* SHOW ONLOAD */
    /*-----------------------------------------------------------------------------------*/

    window.addEventListener("load", function() {
    
      setTimeout(() => {
        
        sessionStorage.setItem('chatActive', 'true');
        chatBot.setAttribute("src", chatData);
        
      }, 3000);
  
    }, {once : true});

    window.addEventListener("load", function() {
    
      setTimeout(() => {

        let showChat = sessionStorage.getItem('chatActive');

        if (showChat == 'true') {
          
          chatDialog.classList.remove('chatbot__dialog--closed');
          chatDialog.classList.add('chatbot__dialog--open');
          chatDialog.setAttribute('aria-hidden', false);

          openChat.classList.remove('chatbot__btn--closed');
          openChat.classList.add('chatbot__btn--open');
          openChat.setAttribute('aria-expanded', true);

          chatTxt.innerHTML="Close chat";

        }

        if (showChat == 'false') {
          
          chatDialog.classList.remove('chatbot__dialog--open');
          chatDialog.classList.add('chatbot__dialog--closed');
          chatDialog.setAttribute('aria-hidden', true);
          
          openChat.classList.remove('chatbot__btn--open');
          openChat.classList.add('chatbot__btn--closed');
          openChat.setAttribute('aria-expanded', false);

          chatTxt.innerHTML="Open chat";

        }
        
      }, 3000);
  
    });

    openChat.addEventListener("click", chatToggle);

  } else {

    /*-----------------------------------------------------------------------------------*/
    /* DON'T SHOW ONLOAD */
    /*-----------------------------------------------------------------------------------*/

    openChat.addEventListener("click", () => {
  
      sessionStorage.setItem('chatActive', 'true');
      chatBot.setAttribute("src", chatData);
      
    }, {once : true});

    openChat.addEventListener("click", chatToggle);

    window.addEventListener("load", function() {

      let showChat = sessionStorage.getItem('chatActive');
      if (showChat == 'true') {
        chatTxt.innerHTML="Open chat";
      }
  
    });

  }

};