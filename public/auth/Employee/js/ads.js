// ads script 

// Script to collapse the sidebar on smaller screens

const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("expand");
});

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

/* Preview advertisement image before Uploading */
function previewImage() {
  let file = document.getElementById("adImage").files;
  if (file.length > 0) {
    let fileReader = new FileReader();

    fileReader.onload = function (event) {
      document.getElementById('preview').setAttribute("src", event.target.result);
      document.getElementById('preview').setAttribute("width", 300);
      document.getElementById('preview').setAttribute("height", 300);
    }

    fileReader.readAsDataURL(file[0])
  }
}

// Check the toggle's status representing the ad's status
const toggleSwitch = document.querySelector('#flexSwitchCheckDefault');
const toggleLabel = document.querySelector('.form-check-label');

toggleSwitch.addEventListener('click', (event) => {
  if (event.target.checked) {
    toggleLabel.textContent = 'مفعل';
  } else {
    toggleLabel.textContent = 'غير مفعل';
  }
})