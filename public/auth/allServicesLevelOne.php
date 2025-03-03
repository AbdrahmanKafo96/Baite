<?php include './includeClient/header.php' ?>

<!-- All services of level one -->
<section id="allServices">
    <div class="container mb-5 p-4">
        <h4 class="my-5 d-block text-center">الخدمات المتوفرة</h4>
        <!-- All services -->
        <div class="row">
            <!-- JS code will fill data here -->
        </div>
        <div class="text-center">
            <a href="#" type="button" class="btn btn-primary my-5 fw-bold">أطلب الأن</a>
            <a href="allServicesClient.php" type="button" class="btn btn-secondary my-5 fw-bold"> الرجوع</a>
        </div>
    </div>
</section>

<script>
    // handleClick function to save the id of the service
    function handleClick(service_id) {
        // alert(service_id);
        sessionStorage.clear();
        sessionStorage.setItem('service_id', service_id);
        window.location.assign('./allServicesLevelTwo.php');
    }


    // Get all services 
    const token = localStorage.getItem('token');
    const id = sessionStorage.getItem('id');
    // console.log(id);


    fetch("http://127.0.0.1:8000/api/get-all-myservices-level-1/" + id, {
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
                    colDiv.setAttribute('class', 'col-md-3 pe-5');

                    colDiv.innerHTML = "<div onclick='handleClick(" + item.id + ")' class='service p-2' style='width: 150px'>" +
                        "<div id='imgWrpr' class='text-center'>" +
                        "<img height='100' width='100' alt='' class='img-fluid p-3'>" +
                        "</div>" +
                        "<div class='info text-center'>" +
                        "<h6>Lorem ipsum dolor sit amet.</h6>" +
                        "<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolores, provident!</p>" +
                        "</div>" +
                        "</div>";

                    document.querySelector('#allServices .container .row').appendChild(colDiv);

                    document.querySelectorAll('.service img')[index].setAttribute('src', item.icon);

                    document.querySelectorAll('.service .info h6')[index].textContent = item.service_name;

                    document.querySelectorAll('.service .info p')[index].textContent = item.description;
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