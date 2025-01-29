// Prepare the values from the Storage session if they exist 
document.addEventListener('DOMContentLoaded', () => {
    // Code to execute after the DOM content is loaded
    console.log(sessionStorage.getItem('name'));
    
    const adName = sessionStorage.getItem('name');
    const startDate = sessionStorage.getItem('start_date').slice(0, 10);
    const endDate = sessionStorage.getItem('end_date').slice(0, 10);
    const show = sessionStorage.getItem('show');

    document.querySelector('#ad-name').value = adName; 
    document.querySelector('#startDate').value = startDate; 
    document.querySelector('#endDate').value = endDate; 
    document.querySelector('#flexSwitchCheckDefault').checked = show; 
           
    console.log(document.querySelector('#flexSwitchCheckDefault').value);
    
});


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
