<!-- This is the cart page displaying client's orders -->
<?php include './includeClient/header.php' ?>
<!-- %%%%%%%%%%%%%% -->
<div class="d-flex flex-column">
    <div id="cart" class="container mb-5">

        <h4 class="text-center my-5">السلة</h4>

        <!-- Dynamic elements here -->

    </div>
</div>

</div>
</section> -->

<script>
    // Get all services 
    const token = localStorage.getItem('token');

    // Global variable to add more items to basket 
    let basketItems = 0;

    function handleDelete(id) {
        alert(id);

        // Delete the Cart item 
        // fetch("http://127.0.0.1:8000/api/carts/" + itemId, {
        //         method: "DELETE",
        //         headers: {
        //             "Content-Type": "application/json",
        //             accept: "application/json",
        //             Authorization: `Bearer ${token}`,
        //         },
        //     })
        //     .then((response) => {
        //         if (!response.ok) {
        //             throw new Error("Network response was not ok");
        //         }
        //         return response.json();
        //     })
        //     .then((data) => {
        //         // Handle successful login, e.g., store token in local storage
        //         console.log("Item Removed From Cart successful:", data);
        //         window.location.replace("./cart.php");
        //     })
        //     .catch((error) => {
        //         console.error(
        //             "There has been a problem with your fetch operation:",
        //             error
        //         );
        //     }); // End of fetch API
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
                <h3 class="text-center">لا توجد خدمات</h3>`;
                document.querySelector('#cart').appendChild(wrapperDiv);
            } else {

                data.map((item, index) => {

                    const colDiv = document.createElement('div');
                    colDiv.setAttribute('class', 'card-body d-flex align-items-center mx-auto mb-5 item');
                    colDiv.style.width = '700px';

                    colDiv.innerHTML = '<img height="110" width="110" alt="" class="img-fluid p-3 mt-3" src="' + item.image1_path + '">' +
                        '<div class="pe-3 ps-5">' +
                        '<h5 class="card-title pt-4">' + item.service_name + '</h5>' +
                        '<p style="line-height:1.6; width: 200px" class="card-text mt-1">' + item.description + '</p>' +
                        '<h6 class="cost">السعر: ' + item.cost + ' دينار</h6>' +
                        '<span onclick="handleDelete(' + item.id + ')" class="d-block rm-btn">حذف</span>' +
                        '</div>';

                    // console.log();
                    document.querySelector('#cart').appendChild(colDiv);

                })

            } // End of mapping
        })
        .catch((error) => {
            console.error(
                "There has been a problem with your fetch operation:",
                error
            );
        });
</script>
<?php include './includeClient/footer.php' ?>