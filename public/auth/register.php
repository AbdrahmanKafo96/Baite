<?php include 'include/template/header.php'; ?>

<section id="login-screen">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">
                <div class="card">
                    <div class="card-body">
                        <form id="registerClient">
                            <div class="form-group">
                                <img class="d-block mx-auto" src="images/sign-in.png" alt="" width="100" height="100">
                                <h3 class="text-center p-4">إنشاء حساب مستخدم</h3>
                                <label class="py-2 fw-bold" for="email">
                                    إسم المستخدم
                                </label>
                                <input type="name"
                                    class="form-control"
                                    id="name"
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
                                <label class="py-2 fw-bold" for="phone_number">
                                    رقم الهاتف
                                </label>
                                <input type="number"
                                    class="form-control"
                                    id="phone_number"
                                    placeholder="رقم الهاتف"
                                    required />
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
                                    id="passwordConf"
                                    placeholder="كلمة المرور"
                                    required />
                            </div>
                            <input type="submit" value="إنشاء حساب" class="btn btn-primary mt-5 w-100 operationButton">
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

<script>
    // client register function

    const regClientform = document.getElementById('registerClient');

    regClientform.addEventListener('submit', function(event) {
        const name = document.querySelector('#name').value;
        const email = document.querySelector('#email').value;
        const password = document.querySelector('#password').value;
        const passConf = document.querySelector('#passwordConf').value;
        const phone_number = document.querySelector('#phone_number').value;

        /* Validate if both fields of password and confirm pass are a match */
        if (password !== passConf) {
            if (document.querySelector('.warning') === null) {
                let warningPara = "<p>حقل كلمة المرور وتأكيد كلمة المرور غير متوافقان</p>";
                const h3 = document.querySelector('#registerClient h3');
                h3.insertAdjacentHTML("afterend", warningPara);
                // Set attribute of class to customize a warning css style
                document.querySelector('#registerClient p').setAttribute('class', 'warning');
            }
        } else {

            fetch('http://127.0.0.1:8000/api/auth/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'accept': 'application/json'
                    },
                    body: JSON.stringify({
                        email: email,
                        password: password,
                        name: name,
                        phone_number: phone_number,
                        is_active: "1",
                        is_trusted: "0",
                        location: "dsds"
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Handle successful login, e.g., store token in local storage
                    // console.log('Register successful:', data.data);
                    // localStorage.setItem('token', data.data.token);
                    // window.location.replace("clientDashBoard.php");

                    if (document.querySelector('.warning') === null) {
                        let warningPara = "<p style='background: blue; color: white'>تمت عملية التسجيل بنجاح</p>";
                        const h3 = document.querySelector('#registerClient h3');
                        h3.insertAdjacentHTML("afterend", warningPara);
                        // Set attribute of class to customize a warning css style
                        document.querySelector('#registerClient p').setAttribute('class', 'warning');

                        setTimeout(function() {
                            document.querySelector('.warning').remove();
                        }, 7000);

                        form.reset();

                    } else {
                        document.querySelector('.warning').remove();
                        let warningPara = "<p style='background: blue'>تمت عملية التسجيل بنجاح</p>";
                        const h3 = document.querySelector('#registerClient h3');
                        h3.insertAdjacentHTML("afterend", warningPara);
                        // Set attribute of class to customize a warning css style
                        document.querySelector('#registerClient p').setAttribute('class', 'warning');

                    }

                    ///////////

                })
                .catch(error => {
                    console.error('There has been a problem with your fetch operation:', error);
                });
        }

        event.preventDefault();
    });
</script>
<!-- <?php include 'include/template/scripts.php'; ?> -->