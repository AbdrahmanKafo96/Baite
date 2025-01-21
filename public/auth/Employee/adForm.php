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
                    <input type="date" class="form-control">
                </div>
                <div class="col-4">
                    <label class="fw-bold p-2">تاريخ نهاية الإعلان</label>
                    <input type="date" class="form-control">
                </div>
            </div>
            <div class="form-check form-switch form-switch-md me-5 mt-4">
                <h6 class="mt-5 pb-2">تفعيل الإعلان</h6>
                <input class="form-check-input arabic-switch-btns" type="checkbox" id="flexSwitchCheckDefault">
                <label class="form-check-label" for="flexSwitchCheckDefault">غير مفعل</label>
            </div>

            <div id="image-uploader" class="form-group mt-5">
                <label for="adImage" class="d-block">
                    <i class="fa-solid fa-image d-inline-block"></i>
                </label>
                <input type="file" id="adImage" name="adImage" accept="image/png, image/gif, image/jpeg" onchange="previewImage()" />
                <img id="preview" class="img-fluid mt-3">
            </div>
            <input type="submit" value="إضافة" class="btn btn-primary mt-4 operationButton fw-bold">
        </form>
    </div>
</div>
<!-- End of the sidebar component -->

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="./js/ads.js"></script>