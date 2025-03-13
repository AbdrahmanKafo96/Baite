<!-- This is the orders page displaying client's orders -->
<?php include './includeClient/header.php' ?>
<!-- %%%%%%%%%%%%%% -->
<div class="container">
    <h2 class="text-center my-5 py-3">الطلبات</h2>
    <div class="d-flex flex-row me-4">
        <!-- <div id="cart" class="container mb-5"> -->

        <!-- Dynamic elements here -->

        <!-- </div> -->
        <!-- <div id="cart_summary" class="mb-5">
        <div class="container mb-4" style="width: 400px; box-shadow:
            0 -0.3rem 1rem rgba(0, 0, 0, 0.15), 
            0.3rem 0 1rem rgba(0, 0, 0, 0.15),
            0 0.3rem 1rem rgba(0, 0, 0, 0.15);">

        </div>
    </div> -->
    </div>
</div>

<script>
    // Get all services 
    const token = localStorage.getItem('token');

    fetch("http://127.0.0.1:8000/api/get-my-order", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                accept: "application/json",
                Authorization: `Bearer ${token}`,
            },
        })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            // Handle successful login, e.g., store token in local storage
            console.log("Orders items retreived successful:", data);

            if (data.length < 1) {
                const wrapperDiv = document.createElement('div');
                wrapperDiv.innerHTML = `<img class="d-block mx-auto img-fluid" src="images/not-found.png" alt="images-not-found" height="500" width="500">
                <h3 class="text-center">لا توجد عناصر فى السلة</h3>
                <div class="text-center">
                <a href="./allServicesLevelTwo.php" style="padding: 6px 50px" type="button" class="btn btn-primary mt-3">الرجوع</a>
                </div>`;
                document.querySelector('#cart').appendChild(wrapperDiv);
            } else {
                data.map((item, index) => {


                    // %%%%%%
                    // Create the summary for the total items
                    const mainSumm = document.createElement('div');
                    mainSumm.setAttribute('id', 'cart_summary' + index + '');
                    mainSumm.setAttribute('class', 'mb-5 cartSpc');

                    document.querySelector('.d-flex').appendChild(mainSumm);

                    contDiv = document.createElement('div');
                    contDiv.setAttribute('class', 'container mb-4');
                    contDiv.style.width = '400px';
                    contDiv.style.boxShadow = '0 -0.3rem 1rem rgba(0, 0, 0, 0.15), 0.3rem 0 1rem rgba(0, 0, 0, 0.15), 0 0.3rem 1rem rgba(0, 0, 0, 0.15)';
                    contDiv.style.paddingTop = '15px';

                    document.querySelector('#cart_summary' + index + '').appendChild(contDiv);

                    summDiv = document.createElement('div');
                    summDiv.setAttribute('class', 'summ_wrapper mx-auto');
                    summDiv.style.width = '300px';
                    summDiv.innerHTML = `<h4 class="text-center p-2 order">معلومات الطلبية</h4>
                    `;

                    document.querySelector(`#cart_summary${index} .container`).appendChild(summDiv);

                    let span1 = document.createElement('span');
                    span1.setAttribute('class', 'd-block item py-1 mt-4 cstm');
                    span1.innerHTML = `<i class="fa-solid fa-barcode"></i> رقم الطلبية:  ${item.order_number}`;

                    document.querySelector(`#cart_summary${index} .container .summ_wrapper`).appendChild(span1);

                    let span2 = document.createElement('span');
                    span2.setAttribute('class', 'd-block item py-1 mt-4 cstm');
                    span2.innerHTML = `<i class="fa-solid fa-hourglass-half"></i> الحالة: ${item.status}`;

                    document.querySelector(`#cart_summary${index} .container .summ_wrapper`).appendChild(span2);

                    let span3 = document.createElement('span');
                    span3.setAttribute('class', 'd-block item py-1 mt-4 cstm');
                    span3.innerHTML = `<i class="fa-solid fa-pencil"></i> الملاحظات: ${item.note}`;

                    document.querySelector(`#cart_summary${index} .container .summ_wrapper`).appendChild(span3);



                    totalSpan = document.createElement('span');
                    totalSpan.setAttribute('class', 'd-block total_price text-center py-5 fw-bold');
                    totalSpan.innerHTML = `<i style="color:blue" class="fa-solid fa-money-check-dollar"></i><span style="color: red"> <span style="color: blue">الإجمالى </span>${item.total_price} دينار </span>`;

                    document.querySelector(`#cart_summary${index} .container`).appendChild(totalSpan);


                    // %%%%%%

                    // start of the inner mapping
                    item.order_details.map((item) => {

                        // const mainDiv = document.createElement('div');
                        // mainDiv.setAttribute('class', 'container mb-5');
                        // mainDiv.setAttribute('id', 'cart' + index + '');
                        // // console.log(mainDiv);


                        // document.querySelector('.d-flex').appendChild(mainDiv);

                        // const colDiv = document.createElement('div');
                        // colDiv.setAttribute('class', 'card-body d-flex align-items-center mx-auto mb-5 item');
                        // colDiv.style.width = '700px';

                        let detail1 = document.createElement('span');
                        detail1.setAttribute('class', 'd-block item py-1 mt-4 cstm');
                        detail1.innerHTML = `<i class="fa-solid fa-wrench"></i> إسم الخدمة: ${item.service_name}`;

                        document.querySelector(`#cart_summary${index} .container .summ_wrapper`).appendChild(detail1);
                        ///////////

                    }) // End of inner mapping

                }) // End of outter mapping

            }
        })
        .catch((error) => {
            console.error(
                "There has been a problem with your fetch operation:",
                error
            );
        });


    function logOut() {
        const token = localStorage.getItem('token');


        fetch('http://127.0.0.1:8000/api/auth/logout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'accept': 'application/json',
                    'Authorization': `Bearer ${token}`
                },
                // body: `{"token": "${token}"}` 
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Handle successful login, e.g., store token in local storage
                console.log('Logout successful:', data);
                localStorage.removeItem('token');
                localStorage.removeItem('id');
                localStorage.removeItem('location');
                localStorage.removeItem('phone_number');
                localStorage.removeItem('name');
                // similar behavior as an HTTP redirect
                window.location.replace("../index.php");
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
    }
</script>
<?php include './includeClient/footer.php' ?>