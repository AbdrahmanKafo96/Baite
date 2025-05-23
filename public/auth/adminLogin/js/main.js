//////////

if (document.readyState === "loading") {

  if(localStorage.getItem('role') === 'admin' && localStorage.getItem('token')) {
    location.assign("../Admin/statistics.php");
  }
}

const form = document.getElementById('loginForm');

form.addEventListener('submit', function(event) {
  if (localStorage.getItem('token') && localStorage.getItem('role')) {
    localStorage.removeItem('token');
    localStorage.removeItem('role');
  }


  // Get all input elements within the form
  const inputs = form.getElementsByTagName('input');

  const email = inputs[0].value;
  const password = inputs[1].value;
  
  // console.log(email);
  // console.log(password);


  fetch('http://127.0.0.1:8000/api/auth/login-admin', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'accept': 'application/json'
    },
    body: JSON.stringify({
      email: email,
      password: password
    })
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {

    // Handle successful login, e.g., store token in local storage
    console.log('Login successful:', data.data.success);

    // if the login attempt failed create a warning span
    if (data.data.success === false) {

      if (document.querySelector('.warning')) {
        console.log('warning exist');
        document.querySelector('.warning').remove();

        let warningPara = "<p>فشل تسجيل الدخول، البريد الإلكتروني أو كلمة المرور خاطئة.</p>";
      const h3 = document.querySelector('#loginForm h3');
      h3.insertAdjacentHTML("afterend", warningPara); 

      // Set attribute of class to customize a warning css style
      document.querySelector('#loginForm p').setAttribute('class', 'warning');

      } else {
        let warningPara = "<p>فشل تسجيل الدخول، البريد الإلكتروني أو كلمة المرور خاطئة.</p>";
        const h3 = document.querySelector('#loginForm h3');
        h3.insertAdjacentHTML("afterend", warningPara); 

        // Set attribute of class to customize a warning css style
        document.querySelector('#loginForm p').setAttribute('class', 'warning');
      }

    } else {
      localStorage.setItem('token', data.data.token); 
      localStorage.setItem('role', 'admin');
      // similar behavior as an HTTP redirect
      window.location.replace("../Admin/statistics.php");
    }
  })
  .catch(error => {
    console.error('There has been a problem with your fetch operation:', error);

    if (document.querySelector('.warning')) {
      console.log('warning exist');
      document.querySelector('.warning').remove();

      let warningPara = "<p>فشل تسجيل الدخول، البريد الإلكتروني أو كلمة المرور خاطئة.</p>";
    const h3 = document.querySelector('#loginForm h3');
    h3.insertAdjacentHTML("afterend", warningPara); 

    // Set attribute of class to customize a warning css style
    document.querySelector('#loginForm p').setAttribute('class', 'warning');

    } else {
      let warningPara = "<p>فشل تسجيل الدخول، البريد الإلكتروني أو كلمة المرور خاطئة.</p>";
      const h3 = document.querySelector('#loginForm h3');
      h3.insertAdjacentHTML("afterend", warningPara); 

      // Set attribute of class to customize a warning css style
      document.querySelector('#loginForm p').setAttribute('class', 'warning');
    }
  });
  
  // stop the form from submitting
  event.preventDefault();
  // Allow the form to submit as usual
});

