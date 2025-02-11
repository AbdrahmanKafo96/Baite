<?php include './includeClient/header.php' ?>

<!-- Start of the carousel containing the ads -->
<div class="container">
    <div id="adsCarousel" class="carousel slide carousel-fade my-4 p-2">
        <!-- <div class="carousel-indicators">
            <button type="button" data-bs-target="#adsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#adsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#adsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div> -->
        <div class="carousel-inner">
            <!-- <div class="carousel-item active">
                <img src="https://www.psu.com/wp/wp-content/uploads/2020/10/ghost-recon-wildlands-ps4-wallpapers-23.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block mb-2">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://images.alphacoders.com/107/thumb-1920-1079182.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block mb-2">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVjjRlIzb926FMOCQFzXqSoPi-Prez9vKUfQ&s" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block mb-2">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div> -->
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
            console.log("Ads retreived successful:", data);
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
</script>

<?php include './includeClient/footer.php' ?>

<!-- Code might be used later as reference for carousel sizing -->
<!-- <div class="carousel slide" data-bs-ride="carousel" style="height: 500px;">  <div class="carousel-inner" style="height: 100%;"> <div class="carousel-item active" style="height: 100%;"> <img src="..." class="d-block w-100" alt="..." style="object-fit: cover; height: 100%;"> </div>
    </div>
</div> -->