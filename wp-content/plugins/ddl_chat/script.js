/*-----------------------------------------------------------------------------------*/
/* CHATBOT TRIGGER */
/*-----------------------------------------------------------------------------------*/

let openChat = document.querySelector('#chatToggle');

if (openChat) {

  let chatDialog = document.querySelector('#chatDialog');
  let chatTxt = openChat.querySelector('.chat__txt');

  openChat.addEventListener("click", () => {
  
    let chatBot = chatDialog.querySelector('iframe');
    let chatData = chatBot.getAttribute('data-src');

    sessionStorage.setItem('chatActive', 'true');
  
    chatBot.setAttribute("src", chatData);
    
  }, {once : true});
  
  openChat.addEventListener("click", () => {
      
    if (chatDialog.classList.contains('chat__dialog--open')) {

      chatDialog.classList.remove('chat__dialog--open');
      chatDialog.classList.add('chat__dialog--closed');
      chatDialog.setAttribute('aria-hidden', true);
      
      openChat.classList.remove('chat__btn--open');
      openChat.classList.add('chat__btn--closed');
      openChat.setAttribute('aria-expanded', false);

      chatTxt.innerHTML="Open chat";

    }
    else {

      chatDialog.classList.remove('chat__dialog--closed');
      chatDialog.classList.add('chat__dialog--open');
      chatDialog.setAttribute('aria-hidden', false);

      openChat.classList.remove('chat__btn--closed');
      openChat.classList.add('chat__btn--open');
      openChat.setAttribute('aria-expanded', true);

      chatTxt.innerHTML="Close chat";

    }
    
  });

  window.addEventListener("load", function() {

    let showChat = sessionStorage.getItem('chatActive');

    if (showChat == 'true') {

      chatTxt.innerHTML="Open chat";

    }
  
    // setTimeout(() => {
    //   openChat.classList.add('XXXXX');
    // }, 3000);

  });

};