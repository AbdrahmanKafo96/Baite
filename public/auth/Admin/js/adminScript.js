// logout function 

function logOut() {
    const token = localStorage.getItem('token');
  
    fetch('http://127.0.0.1:8000/api/auth/logout-admin', {
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
      // similar behavior as an HTTP redirect
      window.location.replace("../../index.php");
    })
    .catch(error => {
      console.error('There has been a problem with your fetch operation:', error);
    });
  }


// Register an Employee function
const form = document.getElementById('registerEmp');

form.addEventListener('submit', function(event) {
  const name = document.querySelector('#name').value;
  const email = document.querySelector('#email').value;
  const password = document.querySelector('#password').value;
  const passConf = document.querySelector('#passwordConf').value;

  /* Validate if both fields of password and confirm pass are a match */
  if (password !== passConf) {
    let warningPara = "<p>حقل كلمة المرور وتأكيد كلمة المرور غير متوافق</p>";
    const h3 = document.querySelector('#registerEmp h3');
    h3.insertAdjacentHTML("afterend", warningPara); 
    // Set attribute of class to customize a warning css style
    document.querySelector('#registerEmp p').setAttribute('class', 'warning');
  }

  fetch('http://127.0.0.1:8000/api/auth/register-employee', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'accept': 'application/json'
    },
    body: JSON.stringify({
      email: email,
      password: password,
      name: name
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
    console.log('Register successful:', data.data);
  })
  .catch(error => {
    console.error('There has been a problem with your fetch operation:', error);
  });

  event.preventDefault();
});
