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
                        <a class="nav-link active" aria-current="page" href="index.php">الرئيسية</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="https://www.google.com">تواصل معنا</a>
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
        <!-- <div id="caption">
            <!-- <div style="background:red; height: 300px; width: 400px"></div> -->
        <!-- <h1 class="text-white text-center pb-2">بيتي</h1>
            <span class="d-block text-white text-center">بيتي الإحتراف فى الخدمة تنوع الخدمات بما يرضيكم</span> -->

        <!-- </div>  -->
        <div class="container">
            <img class="d-block mx-auto" src="{{ asset('assets/hero.png') }}" alt="Gear Image">
        </div>
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
                    <img class="img-fluid" src="{{ asset('assets/appliance.jpg') }}" alt=" services">
                </div>
            </div>
        </div>
    </article>

    <!-- End of the main article  -->

    <!-- Start of the second article  -->

    <article id="service-advantages" class="mt-5 p-4">
        <div class="container text-center">
            <div class="wrapper py-5">
                <h2 class="pb-2">لماذا تختار تطبيقنا؟</h2>
                <span>يعتبر تطبيق أجير للصيانة من أفضل التطبيقات السعودية في الصيانة من خلال الجوال
                </span>
            </div>
            <div id="features" class="d-flex justify-content-center p-3 text-white fw-bold">
                <div class=" bg-info me-3 feature_box"><img src="{{ asset('assets/hammer.png') }}" width="70" height="70" alt=""><span class="d-block">صيانة</span></div>
                <div class="p-2 bg-warning me-3 feature_box"><img class="mt-2" src="{{ asset('assets/install.png') }}" width="70" height="70" alt=""><span class="d-block"> كشف تقني</div>
                <div class="p-2 bg-success me-3 feature_box"><img class="mt-2" src="{{ asset('assets/tool2.png') }}" width="70" height="70" alt=""><span class="d-block">تركيب</div>
                <div class="p-2 bg-info me-3 feature_box"><img class="mt-2" src="{{ asset('assets/inspect.png') }}" width="70" height="70" alt=""><span class="d-block">فحص</div>

            </div>
        </div>
    </article>

    <section id="engineers">
        <div class="container my-5">
            <div class="row p-4">
                <div class="col-12 col-md-6">
                    <img src="{{ asset('assets/engineer.jpg') }}" alt="">
                </div>
                <div class="col-12 col-md-6">
                    <h2 class="pt-5"><i class="fa-solid fa-circle-check text-primary"></i> مهندسين ذو خبرة</h2>
                    <p class="lead pe-4">مهندسون ذو خبرة عالية وسنوات عديدة فى مجال الصيانة</p>
                    <h2 class="pt-5"><i class="fa-solid fa-circle-check text-primary"></i> مهارة عالية</h2>
                    <p class="lead pe-4">مهارة عالية فى الأداء والمهام المطلوبة</p>
                    <h2 class="pt-5"><i class="fa-solid fa-circle-check text-primary"></i> سرعة وفعالية</h2>
                    <p class="lead pe-4"> سرعة فى إتمام المهام المطلوبة حسب الطلب</p>
                    <h2 class="pt-5"><i class="fa-solid fa-circle-check text-primary"></i> ضمان وأمان</h2>
                    <p class="lead pe-4">دقة وضمان فعالية التركيب والصيانة</p>
                </div>
            </div>
        </div>
    </section>

    <section id="map">
        <div class="container my-5">
            <div class="row p-4">
                <div class="col-12 col-md-6 p-4">
                    <h2 class="p-2"><i class="fa-solid fa-map text-primary"></i> مناطق تواجد خدماتنا</h2>
                    <p>وكلائنا يوفرون خدماتنا فى مختلف مناطق ليبيا المختلفة</p>
                    <a role="button" href="./contact.blade.php" class="btn btn-primary fw-bold pe-4 ps-4">تواصل معنا</a>
                </div>
                <div class="col-12 col-md-6">
                    <img src="{{ asset('assets/map.png') }}" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- End of the second article  -->

    <!-- the reference to main.js shall be removed later -->
    <?php include 'auth/include/template/footer.php' ?>
    <?php include 'auth/include/template/scripts.php' ?>