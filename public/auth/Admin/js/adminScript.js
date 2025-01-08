// Script to collapse the sidebar on smaller screens

const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});

/* Code to manipulate data set in table */

// token of the admin that was already saved and will be used to fetch the data
const token = localStorage.getItem('token');

$(document).ready(function() {
  $('#myTable').DataTable({
      ajax: {
          url: 'http://127.0.0.1:8000/api/employees',
          method: 'GET',
          headers: {
              'Content-Type': 'application/json',
              'Authorization': `Bearer ${token}`
          },
          dataSrc: 'data' // Assuming the response data is directly in the array
      },
      // data: data,
      columns: [
          {
              data: 'id'
          },
          // {
          //     data: 'created_at'
          // },
          {
              data: 'name'
          },
          {
              data: 'email'
          },
          {
              data: 'is_active'
          }
          // {
          //     data: 'updated_at'
          // }
      ]
  });

  // Customizing DataTable to the requirements of arabic langauge
  document.querySelector('label').innerHTML = 'سجلات';
  document.querySelector('label').classList.add('me-2');
  document.querySelector('.dt-search label').innerHTML = '';
  document.getElementById('dt-search-0').style.border = '1.6px solid gray';
  document.getElementById('dt-search-0').placeholder = 'البحث فى السجلات';
  document.getElementById('dt-search-0').classList.add('me-4');
});

/* ===================================== */

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
