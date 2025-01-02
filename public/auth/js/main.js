// login form for client

// Register an Employee function
const form = document.getElementById('loginForm');

form.addEventListener('submit', function(event) {
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
    localStorage.setItem('location', data.data.location); 
    localStorage.setItem('phone_number', data.data.phone_number); 
    window.location.replace("clientDashBoard.php");
  })
  .catch(error => {
    console.error('There has been a problem with your fetch operation:', error);
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