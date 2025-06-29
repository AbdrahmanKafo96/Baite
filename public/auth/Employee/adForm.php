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
            <!-- <li class="sidebar-item">
                <a href="employeesRecords.php" class="sidebar-link">
                    <i class="fas fa-users"></i>
                    <span class="pe-2">إدارة الموظفين</span>
                </a>
            </li> --> -->
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
            <!-- <li class="sidebar-item">
                <a href="employeesRecords.php" class="sidebar-link">
                    <i class="fas fa-users"></i>
                    <span class="pe-2">إدارة الموظفين</span>
                </a>
            </li> -->
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
            <h1 class="text-right m-3">إضافة إعلان جديد</h1>
            <a href="./ads.php" type="button" class="btn btn-primary my-4 px-5 pe-3 me-3 fw-bold" style="border-radius: 15px;">
                <i class="fa-solid fa-ad"></i>
                <span>الرجوع إلى الإعلانات</span>
            </a>
        </div>
        <!-- Form to add new ads -->
        <form id="adForm" class="m-3">
            <div class="form-group">
                <label class="py-2 fw-bold" for="email">
                    إسم الإعلان
                </label>
                <input type="text"
                    class="form-control w-50"
                    id="ad-name"
                    placeholder="إسم الإعلان" required />
            </div>
            <span class="d-block mt-5 mb-3">ملاحطة: تاريخ بداية الإعلان يجب أن يكون أصغر من تاريخ النهاية .
            </span>
            <div class="row mt-4">
                <div class="col-4">
                    <label class="fw-bold p-2">تاريخ بداية الإعلان</label>
                    <input id="startDate" type="date" class="form-control" required>
                </div>
                <div class="col-4">
                    <label class="fw-bold p-2">تاريخ نهاية الإعلان</label>
                    <input id="endDate" type="date" class="form-control" required>
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

<!-- Success Modal -->

<!-- <h1 class="text-center text-white bg-primary p-4">عملية الإضافة</h1>
<div class="container mt-5">
    <div class="wrapper d-flex justify-content-center align-items-center flex-column">
        <span class="d-block text-primary p-4"><i class="fa-solid fa-circle-check text-center" style='font-size: 90px'></i></span>
        <h2>تمت العملية بنجاح</h2>
        <span class="p-3">سيتم إعادة التوجيه الأن</span>
        <div class="spinner-border text-muted mt-3"></div>
    </div>
</div> -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="./js/ads.js"></script>
