<!-- Employees Records Page  -->
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
                        <th scope="col" style="text-align: right">حالة الحساب</th>
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

<script>
    // Script to fetch Employees' Records

    // token of the admin that was already saved and will be used to fetch the data
    // const token = localStorage.getItem('token');

    // window.addEventListener('DOMContentLoaded', () => {
    //     fetch('http://127.0.0.1:8000/api/employees', {
    //             method: 'GET',
    //             headers: {
    //                 'Content-Type': 'application/json',
    //                 'accept': 'application/json',
    //                 'Authorization': `Bearer ${token}`
    //             },
    //             // body: `{"token": "${token}"}` 
    //         })
    //         .then(response => {
    //             if (!response.ok) {
    //                 throw new Error('Network response was not ok');
    //             }
    //             return response.json();
    //         })
    //         .then(data => {
    //             // Handle successful login, e.g., store token in local storage
    //             console.log('Fetch was successful:', data);
    //             ////////
    //             // const table = document.getElementById('myTable');
    //             // const empsRecords = data.data;

    //             // empsRecords.map((record) => {
    //             //     var row = table.insertRow();

    //             //     var cell1 = row.insertCell(0);
    //             //     var cell2 = row.insertCell(1);
    //             //     var cell3 = row.insertCell(2);
    //             //     var cell4 = row.insertCell(3);
    //             //     var cell5 = row.insertCell(4);
    //             //     var cell6 = row.insertCell(5);
    //             //     var cell7 = row.insertCell(6);

    //             //     cell1.innerHTML = `${record.id}`;
    //             //     cell2.innerHTML = `${record.created_at}`;
    //             //     cell3.innerHTML = `${record.name}`;
    //             //     cell4.innerHTML = `${record.email}`;
    //             //     cell5.innerHTML = `${record.password}`;
    //             //     cell6.innerHTML = `${record.is_active}`;
    //             //     cell7.innerHTML = `${record.updated_at}`;

    //             // })

    //             ////////
    //             // similar behavior as an HTTP redirect
    //             // window.location.replace("../../index.php");
    //         })
    //         .catch(error => {
    //             console.error('There has been a problem with your fetch operation:', error);
    //         });
    // });
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="./js/adminScript.js"></script>