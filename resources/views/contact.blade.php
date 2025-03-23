<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
    ">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="auth/css/main.css">
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
                        <a href="{{ route('/') }}" class="nav-link active" aria-current="page">الرئيسية</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">تواصل معنا</a>
                    </li>
                    <a href="auth/login.php" type="button" class="btn btn-primary operationButton">تسجيل الدخول</a>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End of the navbar -->

    <h1 class="text-center my-5">تواصل معنا</h1>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-6 pe-5">
                    <img class="pe-5" src="{{ asset('assets/contact.png') }}" alt="contact us">
                </div>
                <div class="col-md-6 pt-5" id="detail">
                    <span class="d-block fw-bold"><i class="fa-solid fa-square-phone"></i> الهاتف: <span class="inner">111-222-333+</span></span>
                    <span class="d-block fw-bold"><i class="fa-brands fa-square-whatsapp"></i> الواتساب: <span class="inner">111-441-231+</span></span>
                    <span class="d-block fw-bold"><i class="fa-brands fa-square-facebook"></i> الفيسبوك: <span class="inner">faebook.com/baite</span></span>
                    <span class="d-block fw-bold"><i class="fa-solid fa-location-dot"></i> الموقع: <span class="inner">طرابلس ليبيا</span></span>
                </div>
            </div>
        </div>
    </section>
    <h5 class="text-center my-5 p-2">بيتي دائما فى خدمتكم</h5>


    <!-- the reference to main.js shall be removed later -->
    <?php include 'auth/include/template/footer.php' ?>
    <?php include 'auth/include/template/scripts.php' ?>