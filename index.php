<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Tefo Hotel - HOME PAGE- fix</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
      <?php require('/xampp/htdocs/hotelbooking/inc/links.php');?>

      <style>
          .availability-form {
            margin-top: -50px ;
            z-index: 2;
            position: relative;
          }
      </style>
  </head>
  <body class="bg-light">
    <!-- NAV Header -->
    <?php require('/xampp/htdocs/hotelbooking/inc/header.php'); ?>
    <!-- CAROUSEL -->
    <div class="container-fluid px-lg-4 mt-4">
      <div class="swiper swiper-container">
        <div class="swiper-wrapper">
          <?php
            $res = selectAll('carousel');
            while ($row = mysqli_fetch_assoc($res)){
                $path = CAROUSEL_IMG_PATH;
                echo<<<data
                  <div class="swiper-slide">
                    <img src="$path$row[image]" class="w-100 d-block">
                  </div>
                data;
            }
          ?>
          
        </div>
      </div>
    </div>

    <!-- Check available room -->
    <div class="container availability-form">
      <div class="row">
        <div class="col-lg-12 bg-white shadow p-4 rounded">
          <h5 class="mb-4">Check Booking Availability</h5>
          <form>
            <div class="row align-items-end">
              <div class="col-lg-3 mb-3">
                <label class="form-label" style="font-weight: 500">Check-in</label>
                <input type="date" class="form-control shadow-none">
              </div>
              <div class="col-lg-3 mb-3">
                <label class="form-label" style="font-weight: 500">Check-out</label>
                <input type="date" class="form-control shadow-none">
              </div>
              <div class="col-lg-3 mb-3">
                <label class="form-label" style="font-weight: 500">Adult</label>
                <select class="form-select shadow-none">
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
              <div class="col-lg-2 mb-3">
                <label class="form-label" style="font-weight: 500">Children</label>
                <select class="form-select shadow-none">
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
              <div class="col-lg-1 mb-lg-3 mt-2">
                <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Our room cards  -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Our Rooms</h2>

    <div class="container">
      <div class="row">
      <?php
        $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?", [1,0], 'ii');
        while ($room_data = mysqli_fetch_assoc($room_res)){
            // get features
            $fea_q = mysqli_query($conn,"SELECT features.name FROM `features`
                INNER JOIN `room_features` ON features.id = room_features.features_id WHERE room_features.room_id = '$room_data[id]'");
            
            $features_data = "";
            while ($fea_row = mysqli_fetch_assoc($fea_q)){
                $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap'>
                    $fea_row[name]
                </span>";
            }
            // get facilities
            $fac_q = mysqli_query($conn,"SELECT facilities.name FROM `facilities`
                INNER JOIN `room_facilities` ON facilities.id = room_facilities.facilities_id WHERE room_facilities.room_id = '$room_data[id]'");
            
            $facilities_data = "";
            while ($fac_row = mysqli_fetch_assoc($fac_q)){
                $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap'>
                    $fac_row[name]
                </span>";
            }
            // thumbnail
            $room_thumb =  ROOMS_IMG_PATH."thumbnail.jpg";
            $thumb_q = mysqli_query($conn, "SELECT * FROM `room_images` 
                        WHERE `room_id`='$room_data[id]' AND `thumb`=1");
            if(mysqli_num_rows($thumb_q) > 0){
                $thumb_res = mysqli_fetch_assoc($thumb_q);
                $room_thumb = ROOMS_IMG_PATH.$thumb_res['image'];
            }
            echo <<< data
              <div class="col-lg-4 col-md-6 my-3">

              <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                <img src="$room_thumb" class="card-img-top" alt="...">
    
                <div class="card-body">
                  <h5>$room_data[name]</h5>
                  <h6 class="mb-4">$room_data[price]$ per night</h6>
                  <!-- Room Features -->
                  <div class="features mb-4">
                    <h6 class="mb-1">Features</h6>
                    $features_data
                  </div>
                  <!-- Room Facilities -->
                  <div class="facilities mb-4">
                    <h6 class="mb1-1">Facilities</h6>
                    $facilities_data
                  </div>
                  <div class="guest mb-4">
                    <h6 class="mb-1">Guests</h6>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        $room_data[adult] Adults
                    </span>
                    <span class="badge rounded-pill bg-light text-dark text-wrap">
                        $room_data[children] Children
                    </span>
                  </div>
                  <!-- Room Booking card -->
                  <div class="d-flex justify-content-evenly mb-2">
                    <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
                    <a href="#" class="btn btn-sm btn-outline-dark  shadow-none">More Details</a>
                  </div>
                </div>
              </div>
            </div>
            data;
          }
        ?>

        <div class="col-lg-12 text-center mt-5">
          <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
        </div>
      </div>
    </div>

    <!-- Our facilities -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Our Facilities</h2>
    <div class="container">
      <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
      <?php
          $res = selectAll('facilities');
          $path = FACILITIES_IMG_PATH;

          while($row = mysqli_fetch_assoc($res)){
            echo<<<data
              <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                <img src="$path$row[icon]" width="80px">
                <h5 class="mt-3">$row[name]</h5>
              </div>
            data;
          }
        ?>
        <div class="col-lg-12 text-center mt-5">
          <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities >>></a>
        </div>
      </div>
    </div>

    <!-- Testimonials -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Testimonials</h2>
    <div class="container mt-5">
      <div class="swiper swiper-testimonials">
        <div class="swiper-wrapper mb-5">

          <div class="swiper-slide bg-white p-4">
            <div class="profile d-flex align-items-center mb-3">
              <img src="images/facilities/star-user.svg" width="30px">
              <h6 class="m-0 ms-2">Random User1</h6>
            </div>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro accusantium exercitationem, praesentium r
              eiciendis nostrum, culpa eius a dolorem in perferendis ipsum veniam saepe sed cupiditate nesciunt? Maxime illo cupiditate nihil!</p>
            <div class="rating">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
            </div>
          </div>
          <div class="swiper-slide bg-white p-4">
            <div class="profile d-flex align-items-center mb-3">
              <img src="images/facilities/star-user.svg" width="30px">
              <h6 class="m-0 ms-2">Random User2</h6>
            </div>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro accusantium exercitationem, praesentium r
              eiciendis nostrum, culpa eius a dolorem in perferendis ipsum veniam saepe sed cupiditate nesciunt? Maxime illo cupiditate nihil!</p>
            <div class="rating">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
            </div>
          </div>
          <div class="swiper-slide bg-white p-4">
            <div class="profile d-flex align-items-center mb-3">
              <img src="images/facilities/star-user.svg" width="30px">
              <h6 class="m-0 ms-2">Random User3</h6>
            </div>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro accusantium exercitationem, praesentium r
              eiciendis nostrum, culpa eius a dolorem in perferendis ipsum veniam saepe sed cupiditate nesciunt? Maxime illo cupiditate nihil!</p>
            <div class="rating">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-half text-warning"></i>
            </div>
          </div>
          <div class="swiper-slide bg-white p-4">
            <div class="profile d-flex align-items-center mb-3">
              <img src="images/facilities/star-user.svg" width="30px">
              <h6 class="m-0 ms-2">Random User4</h6>
            </div>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro accusantium exercitationem, praesentium r
              eiciendis nostrum, culpa eius a dolorem in perferendis ipsum veniam saepe sed cupiditate nesciunt? Maxime illo cupiditate nihil!</p>
            <div class="rating">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-half text-warning"></i>
            </div>
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

    <!-- Reach Us -->
    

    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Reach Us</h2>
    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
          <iframe class="w-100 rounded" height="300px" src="<?php echo $contact_r['iframe'] ?>"></iframe>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="bg-white p-4 rounded mb-4">
            <h5>Call us</h5>
            <i class="bi bi-telephone-fill">
            <a href="tel: +<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark"><?php echo $contact_r['pn1']; ?></a>
            </i>
            <br>

            <?php
              if($contact_r['pn2'] != ''){
                echo<<<data
                <a href="tel: +$contact_r[pn2] " class="d-inline-block mb-2 text-decoration-none text-dark">
                  <i class="bi bi-telephone-fill">  $contact_r[pn2]</i>
                </a>
                <br>
                data;
              }
            ?>
            
          </div>
          <div class="bg-white p-4 rounded mb-4">
            <h5>Contact us</h5>
            <?php
              if($contact_r['fb']!=''){
                echo<<<data
                  <a href="$contact_r[fb]" class="d-inline-block mb-3">
                    <span class="badge bg-light text-dark fs-6 p-2">
                      <i class="bi bi-facebook"></i> Facebook
                    </span>
                  </a>
                  <br>
                data;
              }
            ?>
            
            <br>
            <a href="$contact_r['twt']" class="d-inline-block mb-3">
              <span class="badge bg-light text-dark fs-6 p-2">
                <i class="bi bi-twitter-x"></i> Twitter
              </span>
            </a>
            <br>
            <a href="$contact_r['ins']" class="d-inline-block mb-3">
              <span class="badge bg-light text-dark fs-6 p-2">
                <i class="bi bi-instagram"></i> Instagram
              </span>
            </a>
            
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php require('/xampp/htdocs/hotelbooking/inc/footer.php'); ?>
    
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
    var swiper = new Swiper(".swiper-container", {
      spaceBetween: 30,
      effect: "fade",
      loop: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false, //delay 3.5s sẽ auto chạy; disable... nếu có người dùng thao tác chuyển thì ngừng (nếu set tru, ở đây set false thì máy vẫn auto chạy)
      }
    });

    var swiper = new Swiper(".swiper-testimonials", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      slidesPerView: "3",
      loop: true,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
      },
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoint: { //màn hình nhỏ thì 1 hình, trung bình thì 2, lớn thì 3 (ví dụ như laptop: 3)
        320: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      }
    });
    </script>
  </body>
</html>