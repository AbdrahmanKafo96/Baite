<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
    ">
    <link rel="stylesheet" href="auth/css/main.css">
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
                        <a class="nav-link active" aria-current="page" href="index.php">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">نبذة عنا</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">خدمات الصيانة المنزلية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">خدمات قطاع الأعمال</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">التسجيل كأجير</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> المدونة الرقمية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> التوظيف</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">تواصل معنا</a>
                    </li>
                    <a href="auth/login.php" type="button" class="btn btn-primary operationButton">تسجيل الدخول</a>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of the navbar -->

    <!-- Start of the Hero Background -->

    <section id="hero-background">
        <!-- Hero background to be added Later ! -->
    </section>

    <!-- End of the Hero Background -->

    <!-- Start of the main article  -->

    <article id="main">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h1>عن تطبيقنا للصيانة</h1>
                    <p>تطبيق للصيانة هو منصة إلكترونية لتوفير خدمات صيانة، مع ربطك بأفضل مزودي الخدمات خلال دقيقتين فقط مع توفير افضل الأسعار وضمان للعمل
                    </p>
                </div>
                <div class="col-12 col-md-6">
                    <img class="img-fluid" src="auth/images/services.png" alt="services">
                </div>
            </div>
        </div>
    </article>

    <!-- End of the main article  -->

    <!-- Start of the second article  -->

    <article id="service-advantages" class="mt-5 p-4">
        <div class="container text-center">
            <div class="wrapper py-5">
                <h2>لماذا تختار تطبيقنا؟</h2>
                <span>يعتبر تطبيق أجير للصيانة من أفضل التطبيقات السعودية في الصيانة من خلال الجوال
                </span>
            </div>
            <div class="d-flex justify-content-center p-3 text-white">
                <div class="p-2 bg-info me-3">Flex item 1</div>
                <div class="p-2 bg-warning me-3">Flex item 2</div>
                <div class="p-2 bg-primary me-3">Flex item 3</div>
            </div>
        </div>
    </article>

    <!-- End of the second article  -->

    <!-- the reference to main.js shall be removed later -->
    <?php include 'auth/include/template/footer.php' ?>
    <?php include 'auth/include/template/scripts.php' ?>
