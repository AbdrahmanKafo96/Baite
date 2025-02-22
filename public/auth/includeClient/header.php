<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
    ">
    <link rel="stylesheet" href="clientCss/client.css">
    <script src="https://kit.fontawesome.com/dcad6c519f.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- ####### -->
    <!-- Start of the navbar -->

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">الشعار</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="clientDashboard.php"><i class="fa-solid fa-house ps-2"></i>الرئيسية</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-toolbox ps-2"></i>خدمات الصيانة المنزلية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-screwdriver-wrench ps-2"></i>خدمات قطاع الأعمال</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-newspaper ps-2"></i> المدونة الرقمية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-envelope ps-2"></i>تواصل معنا</a>
                    </li>
                    <a href="#" type="button" class="btn btn-primary cart-container"><i class="fa-solid fa-cart-shopping"></i>السلة<span class="badge text-bg-danger"></span> </a>

                </ul>
            </div>
        </div>
        <a href="login.php" type="button" class="btn btn-danger operationButton ms-4"><i class="fa-solid fa-right-from-bracket ps-2"></i>تسجيل الخروج</a>
    </nav>