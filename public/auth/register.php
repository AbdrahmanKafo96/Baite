<?php include 'include/template/header.php'; ?>

<section id="login-screen">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">
                <div class="card">
                    <div class="card-body">
                        <form id="loginForm" action="">
                            <div class="form-group">
                                <img class="d-block mx-auto" src="images/sign-in.png" alt="" width="100" height="100">
                                <h3 class="text-center p-4">إنشاء حساب</h3>
                                <label class="py-2 fw-bold" for="email">
                                    إسم المستخدم
                                </label>
                                <input type="email"
                                    class="form-control"
                                    id="username"
                                    placeholder="إسم المستخدم" required />
                            </div>
                            <div class="form-group">
                                <label class="py-2 fw-bold" for="email">
                                    البريد الإلكتروني
                                </label>
                                <input type="email"
                                    class="form-control"
                                    id="email"
                                    placeholder="البريد الإلكتروني" required />
                            </div>
                            <div class="form-group">
                                <label class="py-2 fw-bold" for="password">
                                    كلمة المرور
                                </label>
                                <input type="password"
                                    class="form-control"
                                    id="password"
                                    placeholder="كلمة المرور"
                                    required />
                            </div>
                            <div class="form-group">
                                <label class="py-2 fw-bold" for="password">
                                    تأكيد كلمة المرور
                                </label>
                                <input type="password"
                                    class="form-control"
                                    id="password"
                                    placeholder="كلمة المرور"
                                    required />
                            </div>
                            <a href="#" type="button" class="btn btn-primary mt-5 w-100 operationButton">
                                إنشاء حساب</a>
                            <a href="../index.php" type="button" class="btn btn-primary mt-2 w-100 operationButton">الرجوع للرئيسية</a>
                        </form>
                        <p class="mt-3 text-center">
                            لديك حساب؟
                            <a href="login.php">سجل دخولك</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'include/template/scripts.php'; ?>