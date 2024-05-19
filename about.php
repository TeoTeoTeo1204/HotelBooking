<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Tefo Hotel - ABOUT US</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
      <?php 
        require('/xampp/htdocs/hotelbooking/inc/links.php');
      ?>
      <style>
        .box {
          border-top-color: var(--teal) !important;
        }
      </style>
     
  </head>
  <body class="bg-light" style="overflow-x: hidden;">
    <?php require('/xampp/htdocs/hotelbooking/inc/header.php'); ?>
  
    <div class="my-5 px-4">
      <h2 class="fw-bold h-font text-center">About Us</h2>
      <div class="h-line bg-light text-center" style="color: black;">-----------------</div>
      <p class="text-center mt-3">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam nisi at iste facilis ipsa,
        eveniet qui consequuntur beatae, voluptas, doloremque pariatur vitae est sed similique 
        placeat enim voluptatum nobis nam.
      </p>
    </div>

    <dv class="container">
      <div class="row justify-content-center align-items-center">
        <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
          <h3 class="mb-3">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eum, quam.</h3>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellat veritatis quos obcaecati
            quibusdam quasi mollitia accusamus maxime odit impedit doloribus perferendis sed sunt nihil,
            nobis sequi possimus voluptate repellendus laboriosam?
          </p>
        </div>
        <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
          <img src="images/about/me.JPG" class="w-100">
        </div>
      </div>
    </dv>

    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-3 col-md-6 mb-4 px-4">
          <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
            <img src="images/about/hotel.svg" width="70px">
            <h4 class="mt-3">100+ ROOMS</h4>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
          <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
            <img src="images/about/customers.svg" width="70px">
            <h4 class="mt-3">200+ CUSTOMERS</h4>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
          <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
            <img src="images/about/rating.svg" width="70px">
            <h4 class="mt-3">150+ REVIEWS</h4>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 px-4">
          <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
            <img src="images/about/staff.svg" width="70px">
            <h4 class="mt-3">200+ STAFFS</h4>
          </div>
        </div>
      </div>
    </div>
    
    <h3 class="my-5 fw-bold h-font text-center">Management Team</h3>
    <div class="container px-4">
      <div class="swiper mySwiper">
        <div class="swiper-wrapper mb-5">
          <?php
            $about_r = selectAll('team_details');
            $path = ABOUT_IMG_PATH;
            while ($row = mysqli_fetch_assoc($about_r)){
              echo<<<data
                <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                  <img src="$path$row[picture]" class="w-100">
                  <h5 class="mt-2">$row[name]</h5>
                </div>
              data;
            }
          ?>

        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

  <?php require('/xampp/htdocs/hotelbooking/inc/footer.php'); ?>

  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 3,
      spaceBetween: 40,
      breakpoint: {
        320: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 3,
        },
      }
    });
  </script>
  </body>
</html>