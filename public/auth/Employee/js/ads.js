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
      document.getElementById('uploaderIcon').style.display = 'none';
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
const adNote = document.querySelector('#adNotification');

toggleSwitch.addEventListener('click', (event) => {
  if (event.target.checked) {
    toggleLabel.textContent = 'مفعل';
    adNote.textContent = 'الإعلان مفعل حالياً وسيظهر للمستخدمين';
  } else {
    toggleLabel.textContent = 'غير مفعل';
    adNote.textContent = 'الإعلان غير مفعل حاليا';
  }
})

// Function to send form data containing the ad image through the API
const adForm = document.querySelector('#adForm'); // The form

adForm.addEventListener('submit', (event) => {
  const fileImgInput = document.querySelector('#adImage').files[0];
  // Check if the fields of ad name and startdate and enddate are empty or not
  const adNameField = document.querySelector('#ad-name').value;
  const startDate = document.querySelector('#startDate').value;
  const endDate = document.querySelector('#endDate').value;
  const switchBtn = document.querySelector('#flexSwitchCheckDefault').checked;
  const token = localStorage.getItem('token');
  
  // Validating the form will be done later
  // if (adNameField.value.trim() === '' || startDate.value.trim() === '' || endDate.value.trim() === '') {
  //   console.log('field is empty');
  // }

  // check if the input file of image is empty or not
  // if (fileImgInput.files.length > 0) {
  //   console.log('image selected');
  // } else {
  //   // if image not selected highlight it with red border
  //   document.querySelector('#adForm #image-uploader label>i').style.border = '3px solid red';    
  // }

  // Sending the photo and other data using formData API within the fetch API
  //Prepare form data
    var formData = new FormData();
    formData.append("url", `${fileImgInput}`);
    //formData.append("url", "http://i.telegraph.co.uk/multimedia/archive/02007/Plate-1_2007614b.jpg"); //url of remote image
    formData.append("name", `${adNameField}`);
    formData.append("start_date", `${startDate}`);
    formData.append("end_date", `${endDate}`);
    formData.append("show", `${switchBtn}`);
    // callService(formData);
  
    console.log(fileImgInput);
    

  fetch('http://127.0.0.1:8000/api/ads', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'accept': 'application/json',
      'Authorization':`Bearer ${token}`
    },
    body: formData
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
})