<!-- Employees Records Page  -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
    ">
    <link rel="stylesheet" href="css/adminStyle.css">
    <script src="https://kit.fontawesome.com/dcad6c519f.js" crossorigin="anonymous"></script>
</head>

<body>
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

        <div class="main p-3 mt-3">
            <div class="me-5">
                <h1 style="font-size: 30px;">إدارة الموظفين</h1>
                <a href="registerEmployee.php" type="button" class="btn btn-primary my-4 px-5 pe-3 me-3 fw-bold" style="border-radius: 15px;">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>إنشاء حساب موظف</span>
                </a>
            </div>

            <div class="container">
                <table id="myTable" class="table mt-4">
                    <thead class="text-center">

                        <tr class="table-primary">
                            <th scope="col" style="text-align: right">الرقم</th>
                            <!-- <th scope="col">تاريخ</th> -->
                            <th scope="col">إسم الموظف</th>
                            <th scope="col">البريد الإلكتروني</th>
                            <!-- <th scope="col" style="text-align: right">حالة الحساب</th> -->
                            <!-- <th scope="col">تاريخ التحديث</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End of the sidebar component -->
    <!-- End of the table of the employees -->

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="./js/empsOps.js"></script>
