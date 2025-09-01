window.addEventListener("load", function() {

  /*-----------------------------------------------------------------------------------*/
  /* GET LIST OF COOKIES FROM JSON */
  /*-----------------------------------------------------------------------------------*/

  function checkCookieNames() {

    fetch('/wp-content/plugins/ddl-cookie-consent/data/cookie-list.json')
    .then(response => response.json())
    .then(data => {
      const dataNames = data.map(item => item.name);
      // const dataProviders = data.map(item => item.provider);
      // const dataCategories = data.map(item => item.category);
      // const dataTypes = data.map(item => item.type);
      // const dataDescriptions = data.map(item => item.description);
      const dataCookies = [];

      dataNames.forEach(name => {
        const provider = data.find(item => item.name === name).provider;
        const type = data.find(item => item.name === name).type;
        const category = data.find(item => item.name === name).category;
        const description = data.find(item => item.name === name).description;
        dataCookies.push({ name: name, provider: provider, type: type, category: category, description: description });
      });

      // console.log(dataCookies);

      /*-----------------------------------------------------------------------------------*/
      /* GET LIST OF COOKIES FROM SITE */
      /*-----------------------------------------------------------------------------------*/

      //list of all the cookies
      // cookieStore.getAll().then(cookies=>console.log(cookies))
      
      if (document.cookie && document.cookie !== '') {

        cookieStore.getAll().then(cookies => {
          const siteCookies = {};
          cookies.forEach(cookie => {
            siteCookies[cookie.name] = { name: cookie.name, expires: cookie.expires };
          });
      
          const cookieMatchs = dataCookies.filter(dataCookie => siteCookies[dataCookie.name]);
      
          cookieMatchs.forEach(cookieMatch => {

            const currentTime = new Date().getTime();
            const expiresTime = new Date(siteCookies[cookieMatch.name].expires).getTime();
            const durationInMs = expiresTime - currentTime;
            const durationInDays = Math.ceil(durationInMs / (1000 * 60 * 60 * 24)); // Convert milliseconds to days
            cookieMatch.duration = durationInDays + ' days'; // Add duration in days to cookieMatch

            const cookieCategory = cookieMatch.category;

            const categoryElement = document.getElementById(cookieCategory);
            if (categoryElement) {

              console.log(categoryElement);

              categoryElement.innerHTML = cookieMatchs.map(cookie => {
                return `
                    <tr>
                      <td>${cookie.name}</td>
                      <td>${cookie.provider}</td>
                      <td>${cookie.category}</td>
                      <td>${cookie.type}</td>
                      <td>${cookie.description}</td>
                    </tr>
                  `;
              }).join('');

            }

          });
        
          // console.log('Matching Cookies:', cookieMatchs);

          // Assuming cookieMatchs is your object containing categories and items
          
         

          // const cookiesDiv = document.getElementById('cookies');

          // cookiesDiv.innerHTML = cookieMatchs.map(cookie => {
          //     return `
          //             <tr>
          //               <td>${cookie.name}</td>
          //               <td>${cookie.provider}</td>
          //               <td>${cookie.type}</td>
          //               <td>${cookie.description}</td>
          //             </tr>
          //           `;
          //   }).join('');



        }).catch(error => {
          console.error("Error retrieving cookies: ", error);
        });

      }

    })
    .catch(error => console.error('Error fetching the cookie list:', error));

  }
  
  checkCookieNames();

});