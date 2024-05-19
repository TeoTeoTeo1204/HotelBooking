<!-- Footer -->

<div class="container-fluid bg-white mt-5">
    <div class="row justify-content-between">
    <div class="col-lg-4 p-4">
        <h3 class="h-font fw-bold fs-3 mb-2">TEFO HOTEL</h3>
        <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam a beatae dolor perspiciatis, numquam, eum n
        atus consequatur doloremque illum ad consectetur eaque explicabo placeat earum impedit fuga error distinctio similique!
        </p>
    </div>
    <!-- SKIP LINKS -->
    <!-- <div class="col-lg-4 p-4">
        <h5 class="mb-3">Links</h5>
        <a href="" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a><br>
        <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
        <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a><br>
        <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">Contact us</a><br>
        <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">About us</a>
    </div> --> 
    <div class="col-lg-4 p-4">
        <h5 class="mb-3">Follow us</h5>
        <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-2 text-dark text-decoration-none">
        <i class="bi bi-facebook"></i> Facebook
        </a><br>
        <a href="<?php echo $contact_r['twt'] ?>" class="d-inline-block mb-2 text-dark text-decoration-none">
        <i class="bi bi-twitter-x"></i> Twitter
        </a><br>
        <a href="<?php echo $contact_r['ins'] ?>" class="d-inline-block mb-2 text-dark text-decoration-none">
        <i class="bi bi-instagram"></i> Instagram
        </a><br>
    </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    function setActive(){
        let navbar = document.getElementById('nav-bar');
        let a_tags = navbar.getElementsByTagName('a');
        for (i=0; i<a_tags.length; i++){
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if(document.location.href.indexOf(file_name) >= 0){
                a_tags[i].classList.add('active');
            }

        }
    }
    setActive();
</script>
