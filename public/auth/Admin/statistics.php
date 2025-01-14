<!-- Statistics page -->
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
            </li>
            <li class="sidebar-item">
                <a href="statistics.php" class="sidebar-link">
                    <i class="fas fa-chart-bar"></i>
                    <span class="pe-2">الإحصائيات</span>
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
    <div id="statistics-section" class="main p-3">
        <div class="text-right m-3">
            <h1> الإحصائيات</h1>
        </div>
        <div class="container stats mt-4">
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-right">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-users fa-2x mr-3"></i>
                            <div class="pe-4">
                                <h5 class="card-title">عدد الزبائن</h5>
                                <p class="card-text">10</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-right">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-list fa-2x mr-3" style="background: pink"></i>
                            <div class="pe-4">
                                <h5 class="card-title">عدد المنتجات</h5>
                                <p class="card-text">16</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-right">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-calculator fa-2x mr-3" style="background: rgba(0, 0, 255, 0.5)"></i>
                            <div class="pe-4">
                                <h5 class="card-title">الكمية المتبقية</h5>
                                <p class="card-text">0</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-5" style="border-top: 2px solid #ccc;">
                <!-- Second -->
                <div class="col-md-4">
                    <div class="card text-right">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-box-open fa-2x mr-3"></i>
                            <div class="pe-4">
                                <h5 class="card-title">عدد القطع فى المخزن</h5>
                                <p class="card-text">20</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-right">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-money-bill-wave fa-2x mr-3" style="background: pink"></i>
                            <div class="pe-4">
                                <h5 class="card-title">قيمة المخزون</h5>
                                <p class="card-text">0 دينار</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-right">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-dollar-sign fa-2x mr-3" style="background: rgba(0, 0, 255, 0.5)"></i>
                            <div class=" pe-4">
                                <h5 class="card-title">إجمالى المبيعات</h5>
                                <p class="card-text"> دينار 0</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-5" style="border-top: 2px solid #ccc;">
                <!-- Third -->
                <h4 class="text-right mb-4">إحصائيات الطلبات</h4>

                <div class="col-md-4">
                    <div class="card text-right">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-question-circle fa-2x mr-3"></i>
                            <div class="pe-4">
                                <h5 class="card-title">عدد الطلبات</h5>
                                <p class="card-text">6</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-right">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-handshake fa-2x mr-3" style="background:pink"></i>
                            <div class="pe-4">
                                <h5 class="card-title">عدد الطلبات المقبولة</h5>
                                <p class="card-text">13</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-right">
                        <div class="card-body d-flex align-items-center">
                            <i class="fas fa-truck fa-2x mr-3" style="background: rgba(0, 0, 255, 0.5)"></i>
                            <div class="pe-4">
                                <h5 class="card-title">عدد الطلبات قيد التوصيل</h5>
                                <p class="card-text"> دينار 0</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <hr style="border-top: 2px solid #ccc;"> -->
            </div>
        </div>
    </div>
</div>
<!-- End of the sidebar component -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="./js/stats.js"></script>
</body>

</html>