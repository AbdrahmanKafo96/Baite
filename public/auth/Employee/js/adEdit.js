// Prepare the values from the Storage session if they exist
/* Note
the code below also fixes a bug with the switch so it can really behave depending on the value received
*/
document.addEventListener('DOMContentLoaded', () => {
    // Code to execute after the DOM content is loaded

    const adName = sessionStorage.getItem('name');
    const startDate = sessionStorage.getItem('start_date').slice(0, 10);
    const endDate = sessionStorage.getItem('end_date').slice(0, 10);
    let show = sessionStorage.getItem('show');

    // console.log(show);

    const toggleLabel = document.querySelector('.form-check-label');
    const adNote = document.querySelector('#adNotification');

    if (show === '1') {
        show = 1;
        toggleLabel.textContent = 'مفعل';
        adNote.textContent = "الإعلان مفعل حالياً وسيظهر للمستخدمين";
    } else {
        show = 0;
        toggleLabel.textContent = 'غير مفعل';
        adNote.textContent = "الإعلان غير مفعل حاليا";
    }

    // console.log(show);

    document.querySelector('#ad-name').value = adName;
    document.querySelector('#startDate').value = startDate;
    document.querySelector('#endDate').value = endDate;
    document.querySelector('#flexSwitchCheckDefault').checked = show;

    const toggleSwitch = document.querySelector('#flexSwitchCheckDefault');

    toggleSwitch.addEventListener("click", (event) => {
        if (event.target.checked) {
            toggleLabel.textContent = "مفعل";
            adNote.textContent = "الإعلان مفعل حالياً وسيظهر للمستخدمين";
        } else {
            toggleLabel.textContent = "غير مفعل";
            adNote.textContent = "الإعلان غير مفعل حاليا";
        }
    });

});
/////////////////////////////////////////////

// Update-Edit Ad form code
const form = document.getElementById('editForm');

form.addEventListener('submit', (event) => {
    const ad = sessionStorage.getItem('id');
    const editedAdNameField = document.querySelector("#ad-name").value;
    const editedStartDate = document.querySelector("#startDate").value;
    const editedEndDate = document.querySelector("#endDate").value;
    const switchBtn = document.querySelector("#flexSwitchCheckDefault").checked;
    const token = localStorage.getItem("token");

    console.log(`name: ${editedAdNameField}`, `start date: ${editedStartDate}`, `end date: ${editedEndDate}`, `switch button: ${switchBtn}`, `token: ${token}`, `id: ${ad}`);

    const formData = new FormData();
        formData.append("_method", "PUT");
        formData.append("name", editedAdNameField);
        formData.append("show",JSON.parse(switchBtn) );
        formData.append("start_date", editedStartDate);
        formData.append("end_date", editedEndDate);


    // Fetch Function
    fetch("http://127.0.0.1:8000/api/ads/" + ad, {
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
            window.location.replace('./ads.php');
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

// Script to collapse the sidebar on smaller screens
const hamBurger = document.querySelector(".toggle-btn");

hamBurger.addEventListener("click", function () {
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
