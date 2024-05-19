<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Tefo Hotel - FACILITIES</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
      <?php 
        require('/xampp/htdocs/hotelbooking/inc/links.php');
      ?>
      <style>
        .pop:hover {
          border-top-color: var(--teal) !important;
          transform: scale(1.03);
          transition: all 0.3s;
        }
      </style>

     
  </head>
  <body class="bg-light">
    <?php require('/xampp/htdocs/hotelbooking/inc/header.php'); ?>
  
    <div class="my-5 px-4">
      <h2 class="fw-bold h-font text-center">Our Facilities</h2>
      <div class="h-line bg-light text-center" style="color: black;">-----------------</div>
      <p class="text-center mt-3">
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam nisi at iste facilis ipsa,
           eveniet qui consequuntur beatae, voluptas, doloremque pariatur vitae est sed similique 
           placeat enim voluptatum nobis nam.
        </p>
    </div>

    <div class="container">
      <div class="row">
        <?php
          $res = selectAll('facilities');
          $path = FACILITIES_IMG_PATH;

          while($row = mysqli_fetch_assoc($res)){
            echo<<<data
              <div class="col-lg-4 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                  <div class="d-flex align-items-center mb-2 ">
                    <img src="$path$row[icon]" width="40px">
                    <h5 class="m-0 ms-3">$row[name]</h5>
                  </div>
                  <p> $row[desc] </p>
                </div>
              </div>
            data;
          }
        ?>
      </div>
    </div>

    <?php require('/xampp/htdocs/hotelbooking/inc/footer.php'); ?>

  </body>
</html>