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

/* Preview advertisement image before Uploading */
function previewImage() {
    let file = document.getElementById("adImage").files;
    if (file.length > 0) {
        let fileReader = new FileReader();

        fileReader.onload = function (event) {
            document.getElementById("uploaderIcon").style.display = "none";
            document
                .getElementById("preview")
                .setAttribute("src", event.target.result);
            document.getElementById("preview").setAttribute("width", 300);
            document.getElementById("preview").setAttribute("height", 300);
        };

        fileReader.readAsDataURL(file[0]);
    }
}

// Check the toggle's status representing the ad's status
const toggleSwitch = document.querySelector("#flexSwitchCheckDefault");
const toggleLabel = document.querySelector(".form-check-label");
const adNote = document.querySelector("#adNotification");

toggleSwitch.addEventListener("click", (event) => {
    if (event.target.checked) {
        toggleLabel.textContent = "مفعل";
        adNote.textContent = "الخدمة مفعلة الأن وستظهر فى لوحة التحكم";
    } else {
        toggleLabel.textContent = "غير مفعل";
        adNote.textContent = "الخدمة غير مفعلة الأن";
    }
});

// Function to send form data containing the service's data through the API
const form = document.querySelector("#adForm"); // The form

form.addEventListener("submit", (event) => {
    const fileImgInput = document.querySelector("#adImage").files[0];
    const serviceName = document.querySelector("#service-name").value;
    const description = document.querySelector("#description").value;
    const switchBtn = document.querySelector("#flexSwitchCheckDefault").checked;
    const token = localStorage.getItem("token");

    console.log(`image: ${fileImgInput}, service name: ${serviceName}, description: ${description}, status: ${switchBtn}, token: ${token}`);
    

        const formData = new FormData();
        formData.append("service_name", serviceName);
        formData.append("description", description);
        formData.append("icon", fileImgInput);
        formData.append("show", switchBtn);

        fetch("http://127.0.0.1:8000/api/services", {
            method: "POST",
            headers: {
               //  'Content-Type': 'multipart/form-data',
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
                console.log("Register successful:", data.data);
                window.location.replace('./servicesForm.php');
            })
            .catch((error) => {
                console.error(
                    "There has been a problem with your fetch operation:",
                    error
                );
        });

    event.preventDefault();
});
