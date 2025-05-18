<?php include './includeClient/header.php' ?>
<!-- %%%%%%%%%%%%%% -->
<!-- This page displays the deepest nested level of services -->
<div class="d-flex flex-column">
    <div id="wrapper" class="container mb-5">

        <h4 class="text-center my-5">الخدمات</h4>

        <!-- Dynamic elements here -->
    </div>
    <div class="text-center">
        <a href="./allServicesClient.php" style="padding: 6px 50px" type="button" class="btn btn-primary mt-3 mb-4">الرجوع</a>
    </div>
</div>

<!-- %%%%%%%%%%%%%% -->

<!-- All services of level one -->
<!-- <section id="allServices" class="d-flex flex-column">
    <div id="wrapper" class="container mb-5 p-4">
        <h4 class="my-5 d-block text-center">الخدمات المتوفرة</h4>
        <!-- All services -->

<!-- %%%%%%%%%%%%%% -->
<!-- <div class="d-flex flex-column">
    <div id="wrapper" class="container">

        <div class="card-body d-flex align-items-center mx-auto" style="width:700px">
            <img height="110" width="110" alt="" class="img-fluid p-3 mt-3" src="http://127.0.0.1:8000/storage/image1_path/Op4WcrjecY8HSeWGZxXdSYGTl9hXQMMoJPVzHRRX.png">
            <div class=" pe-3">
                <h5 class="card-title pt-4">عدد الزبائن</h5>
                <p style="line-height:1.6" class="card-text mt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis, reprehenderit.</p>
                <h6 class="cost">Cost 100LYD</h6>
            </div>

            <button class="btn btn-primary mt-5 ms-2 me-5 py-2 px-4" type="button">أطلب</button>
            <button type="button" class="btn btn-outline-primary mt-5 btnCustom">تفاصيل</button>
        </div>
    </div>
</div> -->

<!-- %%%%%%%%%%%%%% -->
</div>
</section> -->

<script>
    // Get all services
    const token = localStorage.getItem('token');
    const id = sessionStorage.getItem('service_id');
    // Global variable to add more items to basket
    let basketItems = 0;

    // Handle Order click
    function handleOrder(element, id) {
        // Save service_id that will go to the cart under different name
        sessionStorage.setItem('order_id', id);

        // console.log(element, id);
        element.textContent = 'في السلة';
        console.log(`items in basket before adding: ${basketItems}`);

        // add one item to basket
        basketItems += 1;
        console.log(basketItems);

        document.querySelector('.cart-container span').textContent = basketItems;

        // Start of Adding item to cart using Fetch api
        const formData = new FormData();
        // formData.append('servcie_id', service_id);
        // formData.append('quantities', 1);
        // console.log(service_id);


        fetch("http://127.0.0.1:8000/api/carts", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'accept': "application/json",
                    Authorization: `Bearer ${token}`,
                },
                body: JSON.stringify({
                    service_id: id,
                    // quantities: 1
                })
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then((data) => {
                // Handle successful login, e.g., store token in local storage
                console.log("Added Item to Cart successful:", data.data);
                // window.location.replace('./adForm.php');
            })
            .catch((error) => {
                console.error(
                    "There has been a problem with your fetch operation:",
                    error
                );
            });
        // End of Fetch API
        element.onclick = null;

    }


    fetch("http://127.0.0.1:8000/api/get-all-myservices-level-2/" + id, {
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
            console.log("Services retreived successful:", data);

            if (data.length < 1) {
                const wrapperDiv = document.createElement('div');
                wrapperDiv.innerHTML = `<img class="d-block mx-auto img-fluid" src="images/not-found.png" alt="images-not-found" height="500" width="500">
                <h3 class="text-center">لا توجد خدمات</h3>`;
                document.querySelector('#wrapper').appendChild(wrapperDiv);
            } else {

                data.map((item, index) => {

                    const colDiv = document.createElement('div');
                    colDiv.setAttribute('class', 'card-body d-flex align-items-center mx-auto mb-5 item');
                    colDiv.style.width = '700px';

                    colDiv.innerHTML = '<img height="110" width="110" alt="" class="img-fluid p-3 mt-3" src="' + item.image1_path + '">' +
                        '<div id="capsule" class="pe-3 ps-5">' +
                        '<h5 class="card-title pt-4">' + item.service_name + '</h5>' +
                        '<p style="line-height:1.6; width: 200px" class="card-text mt-1">' + item.description + '</p>' +
                        '<h6 class="cost">السعر: ' + item.cost + ' دينار</h6>' +
                        '</div>' +

                        '<a onclick="handleOrder(this,' + item.id + ')" class="btn btn-primary mt-5 ms-2 me-5 py-2 px-4 order" type="button">أطلب</a>' +

                        '<a type="button" class="btn btn-outline-primary mt-5 btnCustom details">تفاصيل</a>';


                    document.querySelector('#wrapper').appendChild(colDiv);
                    if (item.price_note === 1) {
                        const priceNote = document.createElement('span');
                        priceNote.textContent = 'يتم التحديد بعد الكشف';
                        priceNote.classList.add('badge', 'rounded-pill', 'text-bg-secondary', 'p-2');

                        document.getElementById('capsule').appendChild(priceNote);
                    }

                })

            } // End of mapping
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
