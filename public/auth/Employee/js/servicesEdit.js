// Script to collapse the sidebar on smaller screens
const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function() {
    document.querySelector("#sidebar").classList.toggle("expand");
});

// logout function

function logOut() {
    const token = localStorage.getItem("token");

    fetch("http://127.0.0.1:8000/api/auth/logout-admin", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                accept: "application/json",
                Authorization: `Bearer ${token}`,
            },
            // body: `{"token": "${token}"}`
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            // Handle successful login, e.g., store token in local storage
            console.log("Logout successful:", data);
            localStorage.removeItem("token");
            // similar behavior as an HTTP redirect
            window.location.replace("../../index.php");
        })
        .catch((error) => {
            console.error(
                "There has been a problem with your fetch operation:",
                error
            );
        });
}


document.addEventListener('DOMContentLoaded', () => {
    // Code to execute after the DOM content is loaded

    const id = sessionStorage.getItem('id');
    const serviceName = sessionStorage.getItem('service_name');
    const serviceDescription = sessionStorage.getItem('service_description');
    let show = sessionStorage.getItem('status');

    // console.log(`Name of service: ${serviceName}, Desciption: ${serviceDescription}, Status: ${status}`);
    
    const toggleLabel = document.querySelector('.form-check-label');
    const adNote = document.querySelector('#adNotification');

    if (show === '1') {
        show = 1;
        toggleLabel.textContent = 'مفعل';
        adNote.textContent = "الخدمة سوف تظهر في لوحة التحكم";
    } else {
        show = 0;
        toggleLabel.textContent = 'غير مفعل';
        adNote.textContent = "الخدمة لن تظهر فى لوحة التحكم";
    }

    // // console.log(show);

    document.querySelector('#service-name').value = serviceName;
    document.querySelector('#description').value = serviceDescription;
    document.querySelector('#flexSwitchCheckDefault').checked = show;

    const toggleSwitch = document.querySelector('#flexSwitchCheckDefault');

    toggleSwitch.addEventListener("click", (event) => {
        if (event.target.checked) {
            toggleLabel.textContent = "مفعل";
            adNote.textContent = "الخدمة سوف تظهر في لوحة التحكم";
        } else {
            toggleLabel.textContent = "غير مفعل";
            adNote.textContent = "الخدمة لن تظهر فى لوحة التحكم";
        }
    });

});
/////////////////////////////////////////////


// Update-Edit Ad form code
const form = document.getElementById('adForm');

form.addEventListener('submit', (event) => {
    const id = sessionStorage.getItem('id');
    const editedServiceName = document.querySelector("#service-name").value;
    const editedServiceDesc = document.querySelector("#description").value;
    const switchBtn = document.querySelector("#flexSwitchCheckDefault").checked;
    const token = localStorage.getItem("token");

    console.log(`ID: ${id}`,`name: ${editedServiceName}`, `Desciption: ${editedServiceDesc}`, `switch button: ${switchBtn}`, `token: ${token}`,);

    const formData = new FormData();
        formData.append("_method", "PUT");
        formData.append("service_name", editedServiceName);
        formData.append("show",JSON.parse(switchBtn) );
        formData.append("description", editedServiceDesc);

    // Fetch Function
    fetch("http://127.0.0.1:8000/api/services/" + id, {
        method: 'POST',
        credentials: 'omit',
        mode: 'same-origin',
        headers: {
            //'Content-Type': "application/json",
            'accept': "application/json",
            Authorization: `Bearer ${token}`,
        },
        body:formData
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            // Handle successful login, e.g., store token in local storage
            console.log("Updated successful:", data.data);
            window.location.replace('./services.php');
        })
        .catch((error) => {
            console.error(
                "There has been a problem with your fetch operation:",
                error
            );
    });

    event.preventDefault();
})

/////////////////////////////////////////////