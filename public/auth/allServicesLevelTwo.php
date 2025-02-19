<?php include './includeClient/header.php' ?>
<!-- %%%%%%%%%%%%%% -->
<div class="d-flex flex-column">
    <div id="wrapper" class="container mb-5">

        <h4 class="text-center my-5">الخدمات</h4>

        <!-- Dynamic elements here -->

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
    console.log(id);


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
                document.querySelector('#allServices .container .row').appendChild(wrapperDiv);
            } else {

                data.map((item, index) => {

                    const colDiv = document.createElement('div');
                    colDiv.setAttribute('class', 'card-body d-flex align-items-center mx-auto mb-5 item');
                    colDiv.style.width = '700px';

                    colDiv.innerHTML = `<img height="110" width="110" alt="" class="img-fluid p-3 mt-3" src="${item.image1_path}">
                    <div class="pe-3 ps-5">
                        <h5 class="card-title pt-4">${item.service_name}</h5>
                        <p style="line-height:1.6; width: 200px" class="card-text mt-1">${item.description}</p>
                        <h6 class="cost">دينار ${item.cost} :السعر</h6>
                    </div>

                    <button class="btn btn-primary mt-5 ms-2 me-5 py-2 px-4" type="button">أطلب</button>
                    <button type="button" class="btn btn-outline-primary mt-5 btnCustom">تفاصيل</button>`;
                    console.log(colDiv);
                    document.querySelector('#wrapper').appendChild(colDiv);

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