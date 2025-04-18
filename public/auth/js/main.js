// login form for client

if (document.readyState === "loading") {

  if(localStorage.getItem('role') === 'client' && localStorage.getItem('token')) {
    location.assign("./clientDashBoard.php");
  }
}


const form = document.getElementById('loginForm');

form.addEventListener('submit', function(event) {
  if (localStorage.getItem('token') && localStorage.getItem('role')) {
    localStorage.removeItem('token');
    localStorage.removeItem('role');
  }


  const email = document.querySelector('#email').value;
  const password = document.querySelector('#password').value;

  fetch('http://127.0.0.1:8000/api/auth/login', {
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
    console.log('Login successful:', data.data);
    localStorage.setItem('name', data.data.name); 
    localStorage.setItem('id', data.data.id); 
    localStorage.setItem('token', data.data.token); 
    localStorage.setItem('role', 'client'); 
    localStorage.setItem('location', data.data.location); 
    localStorage.setItem('phone_number', data.data.phone_number); 
    window.location.replace("clientDashBoard.php");
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

  event.preventDefault();
});

// logout function 

function logOut() {
  const token = localStorage.getItem('token'); 


  fetch('http://127.0.0.1:8000/api/auth/logout', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'accept': 'application/json',
      'Authorization':`Bearer ${token}`
    },
    // body: `{"token": "${token}"}` 
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    // Handle successful login, e.g., store token in local storage
    console.log('Logout successful:', data);
    localStorage.removeItem('token');
    localStorage.removeItem('id');
    localStorage.removeItem('location');
    localStorage.removeItem('phone_number');
    localStorage.removeItem('name');
    // similar behavior as an HTTP redirect
    window.location.replace("../index.php");
  })
  .catch(error => {
    console.error('There has been a problem with your fetch operation:', error);
  });
}

