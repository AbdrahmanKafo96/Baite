<?php include './includeClient/header.php' ?>

<!-- Start of the carousel containing the ads -->
<div class="container">
    <div id="adsCarousel" class="carousel slide carousel-fade my-4 p-2" data-bs-ride="carousel">
        <div class="carousel-inner">
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#adsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#adsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- End of the carousel containing the ads -->

<!-- Start of the services section -->

<section id="services">
    <div class="container">
        <h4 class="my-5 d-block text-center">الخدمات المتوفرة</h4>
        <!-- All services -->
        <div class="row">
            <!-- JS code will fill data here -->
        </div>
        <div class="text-center">
            <button type="button" class="btn btn-outline-primary my-5 btnCustom ">جميع الخدمات</button>
        </div>
    </div>
</section>

<!-- End of the services section -->


<!-- Start of the js script -->


<script>
    // Load the ads if ads exist if not load the illustration
    const token = localStorage.getItem('token');

    fetch("http://127.0.0.1:8000/api/ads", {
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
            // console.log("Ads retreived successful:", data);
            // window.location.replace("../../index.php");
            if (data.length < 1) {
                const wrapperDiv = document.createElement('div');
                wrapperDiv.innerHTML = `<img class="d-block mx-auto img-fluid" src="images/ad.png" alt="images-not-found" height="500" width="500">
                <h3 class="text-center">لا توجد خدمات</h3>`;
                document.querySelector('.carousel').remove();
                document.getElementById('adsSection').appendChild(wrapperDiv);
            } else {
                data.map((item, index) => {

                    if (index === 0) {
                        const indicatorsWrapper = document.createElement('div');
                        indicatorsWrapper.setAttribute('class', 'carousel-indicators');
                        indicatorsWrapper.innerHTML = `<button type="button" data-bs-target="#adsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>`;

                        carouselMain = document.getElementById('adsCarousel');
                        carouselMain.insertBefore(indicatorsWrapper, carouselMain.firstChild);
                        /////////////
                        // When index === 0 create inner item with active class
                        const carouselItem = document.createElement('div');
                        carouselItem.setAttribute('class', 'carousel-item active');
                        document.querySelector('.carousel-inner').appendChild(carouselItem);
                        // Now adding the image as the first active image
                        const img = document.createElement('img');
                        img.setAttribute('src', `${item.url}`);
                        img.setAttribute('class', 'img-fluid d-block w-100 carousel-image');
                        img.setAttribute('alt', 'إعلان');

                        document.querySelectorAll('.carousel-item')[0].appendChild(img);

                        // Add caption and populate with the ad's name
                        const caption = document.createElement('div');
                        caption.setAttribute('class', 'carousel-caption d-none d-md-block mb-2');

                        document.querySelectorAll('.carousel-item')[0].appendChild(caption);

                        const ad = document.createElement('h5');
                        ad.textContent = `${item.name}`;

                        document.querySelectorAll('.carousel-caption')[0].appendChild(ad);

                    } else if (index > 0) {
                        const btn = document.createElement('button');
                        btn.setAttribute('type', 'button');
                        btn.setAttribute('data-bs-target', '#adsCarousel');
                        btn.setAttribute('data-bs-slide-to', index);
                        btn.setAttribute('aria-label', `Slide ${index}`);

                        document.querySelector('.carousel-indicators').appendChild(btn);

                        // Now to populate the other items with data 
                        const carouselItem = document.createElement('div');
                        carouselItem.setAttribute('class', 'carousel-item');
                        document.querySelector('.carousel-inner').appendChild(carouselItem);

                        const img = document.createElement('img');
                        img.setAttribute('src', `${item.url}`);
                        img.setAttribute('class', 'img-fluid d-block w-100 carousel-image');
                        img.setAttribute('alt', 'إعلان');


                        document.querySelectorAll('.carousel-item')[index].appendChild(img);

                        // Add caption and populate with the ad's name
                        const caption = document.createElement('div');
                        caption.setAttribute('class', 'carousel-caption d-none d-md-block mb-2');

                        document.querySelectorAll('.carousel-item')[index].appendChild(caption);

                        const ad = document.createElement('h5');
                        ad.textContent = `${item.name}`;

                        document.querySelectorAll('.carousel-caption')[index].appendChild(ad);
                    }
                    ///////
                })
            }
            document.querySelector('.carousel-indicators').style.visibility = 'hidden';
        })
        .catch((error) => {
            console.error(
                "There has been a problem with your fetch operation:",
                error
            );
        });

    //////////////////////////////////////////////
    // Get all services 
    fetch("http://127.0.0.1:8000/api/services", {
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
            // window.location.replace("../../index.php");
            if (data.length < 1) {
                const wrapperDiv = document.createElement('div');
                wrapperDiv.innerHTML = `<img class="d-block mx-auto img-fluid" src="images/not-found.png" alt="images-not-found" height="500" width="500">
                <h3 class="text-center">لا توجد خدمات</h3>`;
                document.querySelector('#services .container .row').appendChild(wrapperDiv);
            } else {

                data.map((item, index) => {

                    const colDiv = document.createElement('div');
                    colDiv.setAttribute('class', 'col-md-3 pe-5');

                    colDiv.innerHTML = `<div class="service" style="width: 150px">
                    <div id="imgWrpr" class="text-center">
                        <img height="100" width="100" alt="" class="img-fluid p-3">
                     </div>
                        <div class="info text-center">
                        <h6>Lorem ipsum dolor sit amet.</h6>
                        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolores, provident!</p>
                        </div>
                    </div>`;

                    document.querySelector('#services .container .row').appendChild(colDiv);

                    document.querySelectorAll('.service img')[index].setAttribute('src', item.icon);

                    document.querySelectorAll('.service .info h6')[index].textContent = item.service_name;

                    document.querySelectorAll('.service .info p')[index].textContent = item.description;
                })

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