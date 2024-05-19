<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Tefo Hotel - ROOMS</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
      <?php 
        require('/xampp/htdocs/hotelbooking/inc/links.php');
      ?>
     
  </head>
  <body class="bg-light" style="overflow-x: hidden;">
    <?php require('/xampp/htdocs/hotelbooking/inc/header.php'); ?>
  
    <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">Our Rooms</h2>
      <div class="h-line bg-light text-center" style="color: black;">-----------------</div>
    </div>

    <div class="container-fluid d-flex align-items-center justify-content-center mx-5">
        <div class="row">
            <div class="col-lg-10 col-md-12 px-4 mx-5">
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

                        // print card
                        echo <<<data
                            <div class="card mb-4 border-0 shadow"  style="font-size: 20px">
                                <div class="row g-0 p-3 align-items-center">
                                    <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                        <img src="$room_thumb" class="img-fluid rounded">
                                    </div>
                                    <div class="col-md-5 px-lg-3 px-md-3 px-0">
                                        <h5>$room_data[name]</h5>
                                        <div class="features mb-4">
                                            <h6 class="mb-1">Features</h6>
                                            $features_data
                                        </div>
                                        <div class="facilities mb-4">
                                            <h6 class="mb1-1">Facilities</h6>
                                            $facilities_data
                                        </div>
                                        <div class="guest">
                                            <h6 class="mb-1">Guests</h6>
                                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                                $room_data[adult] Adults
                                            </span>
                                            <span class="badge rounded-pill bg-light text-dark text-wrap">
                                                $room_data[children] Children
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <h6 class="mb-4">$room_data[price]$ per night</h6>
                                        <a href="#" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Book Now</a>
                                        <a href="#" class="btn btn-sm w-100 btn-outline-dark  shadow-none">More Details</a>
                                    </div>
                                </div>
                            </div>
                        data;
                    }
                ?>
            </div>
            
        </div>
    </div>
    
    <?php require('/xampp/htdocs/hotelbooking/inc/footer.php'); ?>


  </body>
</html>