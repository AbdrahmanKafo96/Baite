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
                <a href="#">لوحة التحكم</a>
            </div>
        </div>
        <ul class="sidebar-nav">
            <!-- <li class="sidebar-item">
                <a href="customersRecords.php" class="sidebar-link">
                    <i class="fa-solid fa-user pe-1"></i>
                    <span class="pe-2">إدارة الزبائن</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="employeesRecords.php" class="sidebar-link">
                    <i class="fas fa-users"></i>
                    <span class="pe-2">إدارة الموظفين</span>
                </a>
            </li> -->
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
                <a href="employeesRecords.php" class="sidebar-link">
                    <i class="fas fa-users"></i>
                    <span class="pe-2">إدارة الموظفين</span>
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
            <h1 class="text-right m-3">تحديث الخدمة </h1>
            <a href="./services.php" type="button" class="btn btn-primary my-4 px-5 pe-3 me-3 fw-bold" style="border-radius: 15px;">
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
            <div class="form-group mt-3">
                <label class="py-2 fw-bold" for="email">
                    وصف الخدمة
                </label>
                <textarea
                    class="form-control w-50"
                    id="description"
                    placeholder="وصف الخدمة" required>
                </textarea>
            </div>

            <div class="form-check form-switch form-switch-md me-5 mt-4">
                <h6 class="mt-5 pb-2">تفعيل الإعلان</h6>
                <input class="form-check-input arabic-switch-btns" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">غير مفعل</label>
                <span id="adNotification" class="d-block pt-3">الإعلان غير مفعل حاليا</span>
            </div>

            <!-- <div id="image-uploader" class="form-group mt-5">
                <label id="uploaderIcon" for="adImage">
                    <i class="fa-solid fa-image d-inline-block"></i>
                </label>
                <input type="file" id="adImage" name="adImage" accept="image/png, image/gif, image/jpeg" onchange="previewImage()" />
                <label for="adImage">
                    <img id="preview" class="img-fluid mt-3">
                </label>
            </div> -->
            <input type="submit" value="إضافة" class="btn btn-primary mt-4 operationButton fw-bold">
        </form>
    </div>
</div>
<!-- End of the sidebar component -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="./js/servicesEdit.js"></script>