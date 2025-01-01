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

  let showChat = sessionStorage.getItem('chatActive');

  function chatOnload() {

    setTimeout(() => {
      
      if (!showChat || showChat == 'true') {
        
      chatBot.setAttribute("src", chatData);
      sessionStorage.setItem('chatActive', 'true');

      chatDialog.classList.remove('chatbot__dialog--closed');
      chatDialog.classList.add('chatbot__dialog--open');
      chatDialog.setAttribute('aria-hidden', false);

      openChat.classList.remove('chatbot__btn--closed');
      openChat.classList.add('chatbot__btn--open');
      openChat.setAttribute('aria-expanded', true);

      chatTxt.innerHTML="Close chat";

      }

    }, 1000);

  }

  if (chatParent.classList.contains('chatbot--onload')) {

    /*-----------------------------------------------------------------------------------*/
    /* SHOW ONLOAD */
    /*-----------------------------------------------------------------------------------*/

    // window.addEventListener("load", chatOnload, {once : true});
    
    window.addEventListener("load", chatOnload);

    // openChat.removeEventListener('click', chatOnload);

    openChat.addEventListener("click", function() {

      if (chatDialog.classList.contains('chatbot__dialog--open')) {

        sessionStorage.setItem('chatActive', 'false');

        chatDialog.classList.remove('chatbot__dialog--open');
        chatDialog.classList.add('chatbot__dialog--closed');
        chatDialog.setAttribute('aria-hidden', true);
        
        openChat.classList.remove('chatbot__btn--open');
        openChat.classList.add('chatbot__btn--closed');
        openChat.setAttribute('aria-expanded', false);

        chatTxt.innerHTML="Open chat";
  
      } else {

        chatBot.setAttribute("src", chatData);
  
        sessionStorage.setItem('chatActive', 'true');

        chatDialog.classList.remove('chatbot__dialog--closed');
        chatDialog.classList.add('chatbot__dialog--open');
        chatDialog.setAttribute('aria-hidden', false);

        openChat.classList.remove('chatbot__btn--closed');
        openChat.classList.add('chatbot__btn--open');
        openChat.setAttribute('aria-expanded', true);

        chatTxt.innerHTML="Close chat";
  
      }
  
    });

    window.addEventListener("load", function() {

      if (showChat == 'false') {
        chatTxt.innerHTML="Open chat";
      }
  
    });

  } else {

    /*-----------------------------------------------------------------------------------*/
    /* DON'T SHOW ONLOAD */
    /*-----------------------------------------------------------------------------------*/

    // openChat.addEventListener("click", () => {
  
    //   sessionStorage.setItem('chatActive', 'true');
    //   chatBot.setAttribute("src", chatData);
      
    // }, {once : true});

    openChat.addEventListener("click", function() {

      if (chatDialog.classList.contains('chatbot__dialog--open')) {

        sessionStorage.setItem('chatActive', 'false');

        chatDialog.classList.remove('chatbot__dialog--open');
        chatDialog.classList.add('chatbot__dialog--closed');
        chatDialog.setAttribute('aria-hidden', true);
        
        openChat.classList.remove('chatbot__btn--open');
        openChat.classList.add('chatbot__btn--closed');
        openChat.setAttribute('aria-expanded', false);

        chatTxt.innerHTML="Open chat";
  
      } else {
  
        sessionStorage.setItem('chatActive', 'true');

        chatBot.setAttribute("src", chatData);

        chatDialog.classList.remove('chatbot__dialog--closed');
        chatDialog.classList.add('chatbot__dialog--open');
        chatDialog.setAttribute('aria-hidden', false);

        openChat.classList.remove('chatbot__btn--closed');
        openChat.classList.add('chatbot__btn--open');
        openChat.setAttribute('aria-expanded', true);

        chatTxt.innerHTML="Close chat";
  
      }
  
    });

    window.addEventListener("load", function() {

      if (showChat == 'true') {

        setTimeout(() => {
  
          chatBot.setAttribute("src", chatData);

          sessionStorage.setItem('chatActive', 'true');
    
          chatDialog.classList.remove('chatbot__dialog--closed');
          chatDialog.classList.add('chatbot__dialog--open');
          chatDialog.setAttribute('aria-hidden', false);
    
          openChat.classList.remove('chatbot__btn--closed');
          openChat.classList.add('chatbot__btn--open');
          openChat.setAttribute('aria-expanded', true);
    
          chatTxt.innerHTML="Close chat";
    
        }, 1000);

      }

      if (showChat == 'false') {
        chatTxt.innerHTML="Open chat";
      }
  
    });

  }

};