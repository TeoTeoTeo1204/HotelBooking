<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Tefo Hotel - CONTACT US</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
      <?php 
        require('/xampp/htdocs/hotelbooking/inc/links.php');
      ?>
      <style>
        .box {
          border-top-color: var(--teal) !important;
        }
        .custom-alert {
          position: fixed; 
          top: 80px; 
          right: 25px;
        } 
      </style>
     
  </head>
  <body class="bg-light" style="overflow-x: hidden;">
    <?php require('/xampp/htdocs/hotelbooking/inc/header.php'); ?>
  
    <div class="my-5 px-4">
      <h2 class="fw-bold h-font text-center">Contact Us</h2>
      <div class="h-line bg-light text-center" style="color: black;">-----------------</div>
      <p class="text-center mt-3">
          Lorem ipsum dolor sit amet consectetur, adipisicing elit. Totam nisi at iste facilis ipsa,
           eveniet qui consequuntur beatae, voluptas, doloremque pariatur vitae est sed similique 
           placeat enim voluptatum nobis nam.
        </p>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 mb-5 px-4">
          <div class="bg-white rounded shadow p-4">
            <iframe class="w-100 rounded mb-4" height="300px" src="<?php echo $contact_r['iframe']; ?>"></iframe>
            <h5>Address</h5>
            <a href="<?php echo $contact_r['gmap']; ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
                <i class="bi bi-geo-alt-fill"></i>Los Angeles, California, USA
            </a>
            <h5>Call us</h5>
            <i class="bi bi-telephone-fill">
                <a href="tel: <?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark"><?php echo $contact_r['pn1']; ?></a>
            </i>
            <br>

            <?php
              if($contact_r['pn2'] != ''){
                echo<<<data
                <a href="tel: +$contact_r[pn2] " class="d-inline-block mb-2 text-decoration-none text-dark">
                  <i class="bi bi-telephone-fill">  $contact_r[pn2]</i>
                </a>
                data;
              }
            ?>
            <h5 class="mt-4">Email</h5>
            <a href="mailto: thanhb2111952@student.ctu.edu.vn"  class="d-inline-block mb-2 text-decoration-none text-dark">
                <i class="bi bi-envelope-arrow-up-fill"></i> <?php echo $contact_r['email'] ?>
            </a>
            <h5 class="mt-4">Follow us</h5>

            <?php
             if($contact_r['fb']!=''){
              echo<<<data
                <a href="$contact_r[fb]" class="d-inline-block mb-3">
                  <i class="bi bi-facebook me-1"></i>
                </a>
              data;
             }
            ?>

            
            <a href="$contact_r[twt]" class="d-inline-block mb-3">
                <i class="bi bi-twitter-x me-1"></i>
            </a>
            <a href="$contact_r[ins]" class="d-inline-block mb-3">
              <i class="bi bi-instagram me-1"></i>
            </a>
            
          </div>
        </div>
        <div class="col-lg-6 col-md-6 mb-5 px-4">
          <div class="bg-white rounded shadow p-4">
            <form method="POST">
                <h5>Send a message</h5>
                <div class="mb-3">
                    <label class="form-label" style="font-weight: 500px">Name</label>
                    <input name="name" required type="text" class="form-control shadow-none">
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-weight: 500px">Email</label>
                    <input name="email" required type="email" class="form-control shadow-none">
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-weight: 500px">Subject</label>
                    <input name="subject" required type="text" class="form-control shadow-none">
                </div>
                <div class="mb-3">
                    <label class="form-label" style="font-weight: 500px">Message</label>
                    <textarea name="message" required class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
                </div>
                <button name="send" type="submit" class="btn text-white custom-bg mt-3">SEND</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <?php require('/xampp/htdocs/hotelbooking/inc/footer.php'); ?>
    <?php
      if(isset($_POST['send'])){
        $frm_data = filteration($_POST);
        $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
        $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];

        $res = insert($q, $values, 'ssss');
        if($res == 1){
          alert('success', 'Your message has been sent');
        }
        else {
          alert('error', 'Can not send message');
        }
      }
    ?>


  </body>
</html>