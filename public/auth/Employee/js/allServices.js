// Delete function 
function handleDelete(id) {
    const itemId = id;
    const token = localStorage.getItem('token');

    fetch("http://127.0.0.1:8000/api/services/" + itemId, {
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
            alert("Service Removed successful!");
            // window.location.replace("../../index.php");
        })
        .catch((error) => {
            console.error(
                "There has been a problem with your fetch operation:",
                error
            );
    });

}


// A function that triggers when edit button is clicked and saves service's details into a sessionStorage
function handleClick(id, name, description, show) {
    console.log(`SERVICE ID: ${id}, SERVICE NAME: ${name}, DESCRIPTION: ${description}, STATUS: ${show}`);
    // clear all session storage before storing the new clicked values
    sessionStorage.clear();

    // Save the values to sessionStorage
    sessionStorage.setItem('id', id);
    sessionStorage.setItem('service_name', name);
    sessionStorage.setItem('service_description', description);
    sessionStorage.setItem('status', show);

    // redirect to the edit form of the ads
    window.location.replace("./servicesUpdate.php");
}


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


// Load the ads if ads exist if not load the illustration
// const adExist = false;
const token = localStorage.getItem('token');

    fetch("http://127.0.0.1:8000/api/services", {
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
            console.log("Services retreived successful:", data);
            // window.location.replace("../../index.php");
            if(data.length < 1) {
                const wrapperDiv = document.createElement('div');
                wrapperDiv.innerHTML = `<img class="d-block mx-auto img-fluid" src="images/ad.png" alt="images-not-found" height="500" width="500">
                <h3 class="text-center">لا توجد خدمات</h3>`;
                document.getElementById('services-section').appendChild(wrapperDiv);
            } else {
                // Create the adds
                data.map((item) => {
                    // console.log(item.url);

                    let colDiv = document.createElement('div');
                    colDiv.classList.add('col-md-3', 'me-5', 'mt-3', 'mb-5');
                    
                    colDiv.innerHTML = '<div id="service" class="card p-2">' +
                    '<img id="adImg" src="' + item.icon + '" alt="Service Image"  style="object-fit: contain; aspect-ratio: 16/9;">' +
                        '<div class="card-body">' +
                            '<h5 class="card-title pb-3 text-right">' + item.service_name + '</h5>' +
                            '<p class="card-text">' + item.description + '</p>' +
                            '<div class="d-flex justify-content-end">' +
                            '<a onclick="handleClick(\'' + item.id + '\', \'' + item.service_name + '\', \'' + item.description + '\', \'' + item.show + '\')" class="btn btn-outline-primary"><i class="fas fa-edit"></i><span class="fw-bold"> تعديل </span></a>' +
                            '<a onclick="handleDelete('+ item.id +')" class="btn btn-outline-danger me-1 "><i class="fas fa-trash"></i><span class="fw-bold"> حذف </span></a>' +
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
            document.getElementById('services-section').appendChild(adNoFoundNote);
        });

/* ^^^^^^^^^^^^^ */