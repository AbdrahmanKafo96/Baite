<!-- Ads dashboard -->
<?php include './include/template/header.php' ?>

<!-- Start of the sidebar component -->
<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="fa-sharp fa-solid fa-chart-line"></i>
            </button>
            <div class="sidebar-logo">
                <a href="./index.php">لوحة التحكم</a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="statistics.php" class="sidebar-link">
                    <i class="fas fa-chart-bar"></i>
                    <span class="pe-2">الإحصائيات</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="ads.php" class="sidebar-link">
                    <i class="fas fa-ad"></i>
                    <span class="pe-2">الإعلانات</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="services.php" class="sidebar-link">
                    <i class="fa-solid fa-briefcase"></i>
                    <span class="pe-2">الخدمات</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="servicesOne.php" class="sidebar-link">
                    <i class="fa-solid fa-headset"></i>
                    <span class="pe-2">قسم الصيانة</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="servicesTwo.php" class="sidebar-link">
                    <i class="fa-solid fa-headset"></i>
                    <span class="pe-2">الخدمات الثانوية</span>
                </a>
            </li>
        </ul>
        <div class="sidebar-footer">
            <a href="#" class="sidebar-link" onclick="logOut()">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="pe-2">تسجيل الخروج</span>
            </a>
        </div>
    </aside>
    <div id="services-section" class="main p-3">
        <div>
            <h1 class="text-right m-3"> لوحة التحكم بالخدمات الثانوية</h1>
            <a href="./servicesTwoForm.php" type="button" class="btn btn-primary my-4 px-5 pe-3 me-3 fw-bold" style="border-radius: 15px;">
                <i class="fa-solid fa-ad"></i>
                <span>إنشاء خدمة ثانوية جديدة</span>
            </a>
        </div>
        <!-- Display the ads in cards if found -->

        <div id="imgsRow" class="row">
        </div>

    </div>
</div>
<!-- End of the sidebar component -->

<script>
    // A function that triggers when edit button is clicked and saves service's details into a sessionStorage
    function handleClick(id, name, description, show, serviceID, imgPath, cost) {
        console.log(`ID: ${id}, SERVICE NAME: ${name}, DESCRIPTION: ${description}, STATUS: ${show}, SERVICE ID: ${serviceID}, Path of image: ${imgPath}, Cost: ${cost}`);
        // clear all session storage before storing the new clicked values
        sessionStorage.clear();

        // Save the values to sessionStorage
        sessionStorage.setItem('id', id);
        sessionStorage.setItem('service_name', name);
        sessionStorage.setItem('service_description', description);
        sessionStorage.setItem('status', show);
        sessionStorage.setItem('serviceID', serviceID);
        sessionStorage.setItem('Path', imgPath);
        sessionStorage.setItem('cost', cost);

        // redirect to the edit form of the ads
        window.location.replace("./servicesTwoUpdate.php");
    }
    // // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    // // Delete function 
    // function handleDelete(id) {
    //     const itemId = id;
    //     const token = localStorage.getItem('token');

    //     fetch("http://127.0.0.1:8000/api/services-level-one/" + itemId, {
    //             method: "DELETE",
    //             headers: {
    //                 "Content-Type": "application/json",
    //                 accept: "application/json",
    //                 Authorization: `Bearer ${token}`,
    //             },
    //         })
    //         .then((response) => {
    //             if (!response.ok) {
    //                 throw new Error("Network response was not ok");
    //             }
    //             return response.json();
    //         })
    //         .then((data) => {
    //             // Handle successful login, e.g., store token in local storage
    //             console.log("Service Removed successful!");
    //             // window.location.replace("../../index.php");
    //         })
    //         .catch((error) => {
    //             console.error(
    //                 "There has been a problem with your fetch operation:",
    //                 error
    //             );
    //         });

    // }

    // Delete function 
    function handleDelete(id) {
        const itemId = id;
        const token = localStorage.getItem('token');

        fetch("http://127.0.0.1:8000/api/services-level-tow/" + itemId, {
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
                console.log("Service Removed successful!");
                window.location.replace("./servicesTwo.php");
            })
            .catch((error) => {
                console.error(
                    "There has been a problem with your fetch operation:",
                    error
                );
            });

    }

    // // Load all Sub Services of level one into the page
    const token = localStorage.getItem('token');

    fetch("http://127.0.0.1:8000/api/services-level-tow", {
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
            console.log("Sub Services retreived successful:", data);
            // window.location.replace("../../index.php");
            if (data.length < 1) {
                const wrapperDiv = document.createElement('div');
                wrapperDiv.innerHTML = `<img class="d-block mx-auto img-fluid" src="images/ad.png" alt="images-not-found" height="500" width="500">
                <h3 class="text-center">لا توجد خدمات</h3>`;
                document.getElementById('services-section').appendChild(wrapperDiv);
            } else {
                // Create the Services cards
                data.map((item) => {
                    // console.log(item.image1_path);
                    let newUrl = item.image1_path.slice(16);
                    console.log(newUrl);


                    let colDiv = document.createElement('div');
                    colDiv.classList.add('col-md-3', 'me-5', 'mt-3', 'mb-5');

                    colDiv.innerHTML = '<div id="service" class="card p-2">' +
                        '<img id="adImg" src="' + newUrl + '" alt="Service Image"  style="object-fit: contain; aspect-ratio: 16/9;">' +
                        '<div class="card-body">' +
                        '<h5 class="card-title pb-3 text-right">' + item.service_name + '</h5>' +
                        '<p class="card-text">' + item.description + '</p>' +
                        '<div class="d-flex justify-content-end">' +
                        '<a onclick="handleClick(\'' + item.id + '\', \'' + item.service_name + '\', \'' + item.description + '\', \'' + item.show + '\', \'' + item.service_id + '\', \'' + item.image1_path + '\', \'' + item.cost + '\')" class="btn btn-outline-primary"><i class="fas fa-edit"></i><span class="fw-bold"> تعديل </span></a>' +
                        '<a onclick="handleDelete(' + item.id + ')"  class="btn btn-outline-danger me-1 "><i class="fas fa-trash"></i><span class="fw-bold"> حذف </span></a>' +
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

    // /* ^^^^^^^^^^^^^ */


    // // Script to collapse the sidebar on smaller screens
    const hamBurger = document.querySelector(".toggle-btn");

    hamBurger.addEventListener("click", function() {
        document.querySelector("#sidebar").classList.toggle("expand");
    });

    // // logout function

    // function logOut() {

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
</script>
<!-- <script src="./js/allServices.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>