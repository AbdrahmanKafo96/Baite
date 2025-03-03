<!-- This is the orders page displaying client's orders -->
<?php include './includeClient/header.php' ?>
<!-- %%%%%%%%%%%%%% -->
<div class="d-flex flex-column">
    <div id="cart" class="container mb-5">

        <h4 class="text-center my-5">السلة</h4>

        <!-- Dynamic elements here -->

    </div>
</div>

<script>
    // Get all services 
    const token = localStorage.getItem('token');

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