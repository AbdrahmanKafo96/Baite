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
                <a href="customersRecords.php" class="sidebar-link">
                    <i class="fas fa-users"></i>
                    <span class="pe-2">سجلات الزبائن</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="orderRecords.php" class="sidebar-link">
                    <i class="fa-solid fa-cubes"></i>
                    <span class="pe-2">سجلات الطلبات</span>
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
    <div id="ads-form" class="main p-3 me-3">
        <div>
            <h1 class="text-right m-3">إضافة خدمة فرعية جديدة</h1>
            <a href="./servicesOne.php" type="button" class="btn btn-primary my-4 px-5 pe-3 me-3 fw-bold" style="border-radius: 15px;">
                <i class="fa-solid fa-ad"></i>
                <span>الرجوع إلى الخدمات</span>
            </a>
        </div>
        <!-- Form to add new ads -->
        <form id="adForm" class="m-3">
            <div class="form-group">
                <label class="py-2 fw-bold" for="email">
                    إسم الخدمة
                </label>
                <input type="text"
                    class="form-control w-50"
                    id="service-name"
                    placeholder="إسم الخدمة" required />
            </div>
            <div class="form-group">
                <label class="py-2 fw-bold" for="email">
                    وصف الخدمة
                </label>
                <textarea
                    class="form-control w-50"
                    id="description"
                    placeholder="وصف الخدمة" required>
                </textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label class="mt-3 fw-bold" for="email">
                        صنف الخدمة
                    </label>
                    <select id="servicesCategory" class="form-select my-3" aria-label=" إختر الصنف">
                        <option value="" disabled selected>إختر الخدمة</option>
                    </select>
                </div>
            </div>

            <div class="form-check form-switch form-switch-md me-5 mt-4">
                <h6 class="mt-5 pb-2">تفعيل الإعلان</h6>
                <input class="form-check-input arabic-switch-btns" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">غير مفعل</label>
                <span id="adNotification" class="d-block pt-3">الإعلان غير مفعل حاليا</span>
            </div>

            <div id="image-uploader" class="form-group mt-5">
                <label id="uploaderIcon" for="adImage">
                    <i class="fa-solid fa-image d-inline-block"></i>
                </label>
                <input type="file" id="adImage" name="adImage" accept="image/png, image/gif, image/jpeg" onchange="previewImage()" />
                <label for="adImage">
                    <img id="preview" class="img-fluid mt-3">
                </label>
            </div>
            <input type="submit" value="إضافة" class="btn btn-primary mt-4 operationButton fw-bold">
        </form>
    </div>
</div>
<!-- End of the sidebar component -->

<script>
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

    // Load All services into the select options menus
    document.addEventListener("DOMContentLoaded", (event) => {
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

                // Create options from the services data
                data.map((item) => {

                    let option = document.createElement('option');
                    option.setAttribute('value', item.id);

                    option.textContent = item.service_name;

                    document.querySelector('#servicesCategory').appendChild(option);


                })
                // End of Code
            })
            .catch((error) => {
                console.error(
                    "There has been a problem with your fetch operation:",
                    error
                );
            });
    });

    // Check the toggle's status representing the ad's status
    const toggleSwitch = document.querySelector("#flexSwitchCheckDefault");
    const toggleLabel = document.querySelector(".form-check-label");
    const adNote = document.querySelector("#adNotification");

    toggleSwitch.addEventListener("click", (event) => {
        if (event.target.checked) {
            toggleLabel.textContent = "مفعل";
            adNote.textContent = "الخدمة ستظهر حاليا فى لوحة التحكم";
        } else {
            toggleLabel.textContent = "غير مفعل";
            adNote.textContent = "الخدمة لن تظهر فى لوحة التحكم";
        }
    });

    /* Preview advertisement image before Uploading */
    function previewImage() {
        let file = document.getElementById("adImage").files;
        if (file.length > 0) {
            let fileReader = new FileReader();

            fileReader.onload = function(event) {
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

    // Function to send form data containing the ad image through the API
    const adForm = document.querySelector("#adForm"); // The form

    adForm.addEventListener("submit", (event) => {

        const fileImgInput = document.querySelector("#adImage").files[0];
        const serviceName = document.querySelector("#service-name").value;
        const description = document.querySelector("#description").value;
        const option = document.querySelector("#servicesCategory").value;
        const switchBtn = document.querySelector("#flexSwitchCheckDefault").checked;
        const token = localStorage.getItem("token");

        console.log(`Image: ${fileImgInput}, Service name: ${serviceName}, Description: ${description}, Option: ${option}, Status: ${switchBtn}`);

        const formData = new FormData();
        formData.append("service_name", serviceName);
        formData.append("description", description);
        formData.append("show", switchBtn);
        formData.append("icon", fileImgInput);
        formData.append("service_id", option);

        fetch("http://127.0.0.1:8000/api/services-level-one", {
                method: "POST",
                headers: {
                    //  'Content-Type': 'multipart/form-data',
                    'accept': "application/json",
                    Authorization: `Bearer ${token}`,
                },
                body: formData
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                // Handle successful login, e.g., store token in local storage
                console.log("Saved successful:", data.data);
                window.location.replace('./servicesOne.php');
            })
            .catch((error) => {
                console.error(
                    "There has been a problem with your fetch operation:",
                    error
                );
            });

        event.preventDefault();
    });
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<!-- <script src="./js/addServices.js"></script> -->