<!-- This is the cart page displaying client's orders -->
<?php include './includeClient/header.php' ?>
<!-- %%%%%%%%%%%%%% -->
<div class="d-flex flex-column">
    <div id="cart" class="container mb-5">

        <h4 class="text-center my-5">السلة</h4>

        <!-- Dynamic elements here -->

    </div>
    <div id="cart_summary" class="mb-5">
        <div class="container mb-4" style="width: 400px; box-shadow:
            0 -0.3rem 1rem rgba(0, 0, 0, 0.15), 
            0.3rem 0 1rem rgba(0, 0, 0, 0.15),
            0 0.3rem 1rem rgba(0, 0, 0, 0.15);">

        </div>
    </div>
</div>

</div>

<script>
    // Get all services 
    const token = localStorage.getItem('token');

    // Global variable to add more items to basket 
    let basketItems = 0;

    // Checkout function to show the thank you message for buying
    function checkOut() {
        document.getElementById('cart').remove();
        document.getElementById('cart_summary').remove();

        let wrapper = document.createElement('div');
        wrapper.setAttribute('id', 'purchase_greet');
        wrapper.setAttribute('class', 'my-5 mt-3 mb-5 text-center');
        wrapper.innerHTML = `<h3 class="mt-5 mb-5">شكرا لك على شرائك</h3>
            <p class="fw-bold" style="font-size: 20px">لقد تم اضافة مقتنياتك إلي الطلبات بنجاح يمكنك مراجعة معلوماتك</p>
            <a href="./allServicesClient.php" style="padding: 6px 50px" type="button" class="btn btn-primary mt-4 mb-3 fw-bold">الرجوع</a>
        `;

        document.querySelector('.d-flex').appendChild(wrapper);
    }

    function handleDelete(id) {
        // alert(id);

        // Delete the Cart item 
        fetch("http://127.0.0.1:8000/api/carts/" + id, {
                method: "DELETE",
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
                console.log("Item Removed From Cart successful:", data);
                window.location.replace("./cart.php");
            })
            .catch((error) => {
                console.error(
                    "There has been a problem with your fetch operation:",
                    error
                );
            }); // End of fetch API
    }

    // Handle Order click
    // function handleOrder(element, id) {
    //     // console.log(element, id);
    //     element.textContent = 'في السلة';
    //     console.log(`items in basket before adding: ${basketItems}`);

    //     // add one item to basket
    //     basketItems += 1;
    //     console.log(basketItems);

    //     document.querySelector('.cart-container span').textContent = basketItems;
    //     element.onclick = null;

    // }


    fetch("http://127.0.0.1:8000/api/carts/", {
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
            console.log("Cart items retreived successful:", data);
            // Update number of items in Cart to the cart icon in navbar
            basketItems += data.length;
            document.querySelector('.cart-container span').textContent = basketItems;
            console.log(basketItems);

            if (data.length < 1) {
                const wrapperDiv = document.createElement('div');
                wrapperDiv.innerHTML = `<img class="d-block mx-auto img-fluid" src="images/not-found.png" alt="images-not-found" height="500" width="500">
                <h3 class="text-center">لا توجد عناصر فى السلة</h3>
                <div class="text-center">
                <a href="./allServicesLevelTwo.php" style="padding: 6px 50px" type="button" class="btn btn-primary mt-3">الرجوع</a>
                </div>`;
                document.querySelector('#cart').appendChild(wrapperDiv);
            } else {
                let total = 0;
                data.map((item, index) => {
                    total += item.service_data.cost;

                    const colDiv = document.createElement('div');
                    colDiv.setAttribute('class', 'card-body d-flex align-items-center mx-auto mb-5 item');
                    colDiv.style.width = '700px';

                    colDiv.innerHTML = '<img height="110" width="110" alt="" class="img-fluid p-3 mt-3" src="' + item.service_data.image1_path + '">' +
                        '<div class="pe-3 ps-5">' +
                        '<h5 class="card-title pt-4">' + item.service_data.service_name + '</h5>' +
                        '<p style="line-height:1.6; width: 200px" class="card-text mt-1">' + item.service_data.description + '</p>' +
                        '<h6 class="cost">السعر: ' + item.service_data.cost + ' دينار</h6>' +
                        '<span onclick="handleDelete(' + item.id + ')" class="d-block rm-btn">حذف</span>' +
                        '</div>';

                    // console.log();
                    document.querySelector('#cart').appendChild(colDiv);




                }) // End of mapping

                // Create the summary for the total items
                summDiv = document.createElement('div');
                summDiv.setAttribute('class', 'summ_wrapper mx-auto');
                summDiv.style.width = '300px';
                summDiv.innerHTML = `<h4 class="text-center p-4">ملخص</h4>
                <h5 class="mt-4">المشتريات</h5>`;

                document.querySelector('#cart_summary .container').appendChild(summDiv);

                totalSpan = document.createElement('span');
                totalSpan.setAttribute('class', 'd-block total_price text-center py-4');
                totalSpan.innerHTML = `<i class="fa-solid fa-money-check-dollar"></i> الإجمالى ${total} دينار`;

                document.querySelector('#cart_summary .container').appendChild(totalSpan);

                div2 = document.createElement('div');
                div2.setAttribute('class', 'text-center p-3');
                div2.innerHTML = `<a onclick="checkOut()" style="padding: 6px 50px" type="button" class="btn btn-primary mt-3 fw-bold">الدفع</a>`;

                document.querySelector('#cart_summary .container').appendChild(div2);

                // console.log(document.querySelector('#cart_summary .container'));

                // Now map through the items and add items in cart to summary
                data.map((item, index) => {

                    let span1 = document.createElement('span');
                    span1.setAttribute('class', 'd-block item py-1 mt-4');
                    span1.innerHTML = `<i class="fa-solid fa-circle-check"></i> ${item.service_data.service_name}`;

                    document.querySelector('#cart_summary .container .summ_wrapper').appendChild(span1);

                    let span2 = document.createElement('span');
                    span2.setAttribute('class', 'd-block item_price py-1');
                    span2.innerHTML = `<i class="fa-regular fa-money-bill-1"></i> ${item.service_data.cost} دينار`;

                    document.querySelector('#cart_summary .container .summ_wrapper').appendChild(span2);

                    console.log(span2);


                })
                // End of map
                console.log(total);

            }
        })
        .catch((error) => {
            console.error(
                "There has been a problem with your fetch operation:",
                error
            );
        });
</script>
<?php include './includeClient/footer.php' ?>