// Check if the user is admin 

if (document.readyState === "loading") {
  console.log(localStorage.getItem('role'));

  if(localStorage.getItem('role') !== 'employee') {
    location.assign("../../index.php");
  }
}


// Script to collapse the sidebar on smaller screens

const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});

// logout function 

function logOut() {
    const token = localStorage.getItem('token');
  
    fetch('http://127.0.0.1:8000/api/auth/logout-employee', {
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
      localStorage.removeItem('role');
      // similar behavior as an HTTP redirect
      window.location.replace("../../index.php");
    })
    .catch(error => {
      console.error('There has been a problem with your fetch operation:', error);
    });
  }
