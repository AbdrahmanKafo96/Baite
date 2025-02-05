// Delete function 
function handleDelete(id) {
    const itemId = id;
    const token = localStorage.getItem('token');

    fetch("http://127.0.0.1:8000/api/ads/" + itemId, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            accept: "application/json",
            Authorization: `Bearer ${token}`,
        },
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            // Handle successful login, e.g., store token in local storage
            console.log("Ads Removed successful:", data);
            // window.location.replace("../../index.php");
        })
        .catch((error) => {
            console.error(
                "There has been a problem with your fetch operation:",
                error
            );
    });

}


// ads script

// A function that triggers when edit button is clicked and saves image's details into a sessionStorage
function handleClick(itemid, itemName, itemUrl, itemShow, startDate, endDate) {
    // console.log(itemid, itemName, itemUrl, itemShow, startDate, endDate);
    // clear all session storage before storing the new clicked values
    sessionStorage.clear();

    // Save the values to sessionStorage
    sessionStorage.setItem('id', itemid);
    sessionStorage.setItem('name', itemName);
    sessionStorage.setItem('url', itemUrl);
    sessionStorage.setItem('show', itemShow);
    sessionStorage.setItem('start_date', startDate);
    sessionStorage.setItem('end_date', endDate);

    // redirect to the edit form of the ads
    window.location.replace("./adEditForm.php");
}

// Load the ads if ads exist if not load the illustration
const adExist = false;
const token = localStorage.getItem('token');

    fetch("http://127.0.0.1:8000/api/ads", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            accept: "application/json",
            Authorization: `Bearer ${token}`,
        },
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            // Handle successful login, e.g., store token in local storage
            console.log("Ads retreived successful:", data);
            // window.location.replace("../../index.php");
            if(data.length < 1) {
                const wrapperDiv = document.createElement('div');
                wrapperDiv.innerHTML = `<img class="d-block mx-auto img-fluid" src="images/ad.png" alt="images-not-found" height="500" width="500">
                <h3 class="text-center">لا توجد إعلانات</h3>`;
                document.getElementById('ads-section').appendChild(wrapperDiv);
            } else {
                // Create the adds
                data.map((item) => {
                    // console.log(item.url);

                    let colDiv = document.createElement('div');
                    colDiv.classList.add('col-md-3', 'me-5', 'mt-3', 'mb-5');
                    
                    colDiv.innerHTML = '<div id="adCard" class="card p-2">' +
                    '<img id="adImg" src="' + item.url + '" alt="Ad Image"  style="object-fit: contain; aspect-ratio: 16/9;">' +
                        '<div class="card-body">' +
                            '<h5 class="card-title pb-3 text-right">' + item.name + '</h5>' +
                            '<div class="d-flex justify-content-end">' +
                            '<a onclick="handleClick(\'' + item.id + '\', \'' + item.name + '\', \'' + item.url + '\', \'' + item.show + '\', \'' + item.start_date + '\', \'' + item.end_date + '\')" class="btn btn-outline-primary"><i class="fas fa-edit"></i><span class="fw-bold"> تعديل </span></a>' +
                            '<a onclick="handleDelete(' + item.id + ')" class="btn btn-outline-danger me-1 "><i class="fas fa-trash"></i><span class="fw-bold"> حذف </span></a>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

                    document.getElementById('imgsRow').appendChild(colDiv);
                })
            }

        })
        .catch((error) => {
            console.error(
                "There has been a problem with your fetch operation:",
                error
            );
            const adNoFoundNote = `<img class="d-block mx-auto img-fluid" src="images/ad.png" alt="images-not-found" height="500" width="500">
            <h3 class="text-center">لا توجد إعلانات</h3>`;
            document.getElementById('ads-section').appendChild(adNoFoundNote);
        });

/* ^^^^^^^^^^^^^ */

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
        adNote.textContent = "الإعلان مفعل حالياً وسيظهر للمستخدمين";
    } else {
        toggleLabel.textContent = "غير مفعل";
        adNote.textContent = "الإعلان غير مفعل حاليا";
    }
});

// Function to send form data containing the ad image through the API
const adForm = document.querySelector("#adForm"); // The form

adForm.addEventListener("submit", (event) => {
    const fileImgInput = document.querySelector("#adImage").files[0];
    // Check if the fields of ad name and startdate and enddate are empty or not
    const adNameField = document.querySelector("#ad-name").value;
    const startDate = document.querySelector("#startDate").value;
    const endDate = document.querySelector("#endDate").value;
    const switchBtn = document.querySelector("#flexSwitchCheckDefault").checked;
    const token = localStorage.getItem("token");

    // if (switchBtn) {
    //     switchBtn = 1;
    // } else {
    //     switchBtn = 0;
    // }


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

    // const reader = new FileReader();
    // reader.readAsDataURL(fileImgInput);

    // reader.onloadend = function () {
    //     const base64Image = reader.result;

        // const data = {
        //     name: adNameField,
        //     show: switchBtn, // or 1
        //     start_date: startDate,
        //     end_date: endDate,
        //     url: base64Image,
        // };
        const formData = new FormData();
        formData.append("name", adNameField);
        formData.append("show", switchBtn);
        formData.append("start_date", startDate);
        formData.append("end_date", endDate);
        formData.append("url", fileImgInput);

        fetch("http://127.0.0.1:8000/api/ads", {
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
            })
            .catch((error) => {
                console.error(
                    "There has been a problem with your fetch operation:",
                    error
                );
        });

    event.preventDefault();
});
