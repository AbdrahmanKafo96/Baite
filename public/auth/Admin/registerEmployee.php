<?php include 'include/template/header.php'; ?>

<section id="regEmp-screen">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 mt-5">
                <div class="card">
                    <div class="card-body">
                        <form id="registerEmp" action="">
                            <div class="form-group">
                                <img class="d-block mx-auto" src="images/sign-in.png" alt="" width="100" height="100">
                                <h3 class="text-center p-4">إنشاء حساب موظف</h3>
                                <label class="py-2 fw-bold" for="name">
                                    الإسم الكامل
                                </label>
                                <input type="text"
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

                            <a href="index.php" type="button" class="btn btn-primary mt-2 w-100 operationButton">الرجوع للرئيسية</a>
                        </form>
                        <!-- <p class="mt-3 text-center">
                            لديك حساب؟
                            <a href="login.php">سجل دخولك</a>
                        </p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Register an Employee function
    const form = document.getElementById('registerEmp');

    form.addEventListener('submit', function(event) {
        const name = document.querySelector('#name').value;
        const email = document.querySelector('#email').value;
        const password = document.querySelector('#password').value;
        const passConf = document.querySelector('#passwordConf').value;

        /* Validate if both fields of password and confirm pass are a match */
        if (password !== passConf) {
            let warningPara = "<p>حقل كلمة المرور وتأكيد كلمة المرور غير متوافق</p>";
            const h3 = document.querySelector('#registerEmp h3');
            h3.insertAdjacentHTML("afterend", warningPara);
            // Set attribute of class to customize a warning css style
            document.querySelector('#registerEmp p').setAttribute('class', 'warning');
        }

        fetch('http://127.0.0.1:8000/api/auth/register-employee', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'accept': 'application/json'
                },
                body: JSON.stringify({
                    email: email,
                    password: password,
                    name: name
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
                console.log('Register successful:', data.data);
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });

        event.preventDefault();
    });
</script>

<!-- <?php include 'include/template/scripts.php'; ?> -->