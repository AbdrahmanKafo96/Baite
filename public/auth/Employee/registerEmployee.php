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

            console.log(password, passConf);

            /* Validate if both fields of password and confirm pass are a match */
            if (password !== passConf) {
                if (document.querySelector('.warning') === null) {
                    let warningPara = "<p>حقل كلمة المرور وتأكيد كلمة المرور غير متوافقان</p>";
                    const h3 = document.querySelector('#registerEmp h3');
                    h3.insertAdjacentHTML("afterend", warningPara);
                    // Set attribute of class to customize a warning css style
                    document.querySelector('#registerEmp p').setAttribute('class', 'warning');
                }
            } else {
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
                        if (document.querySelector('.warning') === null) {
                            let warningPara = "<p style='background: blue; color: white'>تمت عملية التسجيل بنجاح</p>";
                            const h3 = document.querySelector('#registerEmp h3');
                            h3.insertAdjacentHTML("afterend", warningPara);
                            // Set attribute of class to customize a warning css style
                            document.querySelector('#registerEmp p').setAttribute('class', 'warning');

                            setTimeout(function() {
                                document.querySelector('.warning').remove();
                            }, 7000);

                            form.reset();

                        } else {
                            document.querySelector('.warning').remove();
                            let warningPara = "<p style='background: blue'>تمت عملية التسجيل بنجاح</p>";
                            const h3 = document.querySelector('#registerEmp h3');
                            h3.insertAdjacentHTML("afterend", warningPara);
                            // Set attribute of class to customize a warning css style
                            document.querySelector('#registerEmp p').setAttribute('class', 'warning');

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

    <!-- <script src="js/adminScript.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html> -->