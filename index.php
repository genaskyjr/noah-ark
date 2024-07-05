<?php 
session_start();

//echo $_SESSION['email'];
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Noah's Ark Cat and Dog Shelter</title>
    <link rel="icon" type="image/png" href="assets/logo.png">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    

    
    <!--bootstrap 5.2.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!--font -->
    <link href="https://fonts.cdnfonts.com/css/helvetica-neue-55" rel="stylesheet">
    <!--homepage css -->
    <link rel="stylesheet" href="css/index.css">
    <!--icon -->
    <script src="https://kit.fontawesome.com/c3cf7a82ce.js" crossorigin="anonymous"></script>
    
    <!-- Use the Bootstrap 5 JavaScript and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <!--jquery cdn -->
    <script
    src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

    <style>
    /* Styles for mobile devices */
    @media only screen and (max-width: 767px) {
      .col-6.col-sm-4.col-md-2 {
        width: 50% !important;
        max-width: 50% !important;
      }
    }
  </style>


  </head>
  <body>


  

<script src="js/zoom.js"></script>

<?php 

include 'components/header.php';
?>


<!-- Header-->
<header class="py-10 mt-5 myheader" id="home">
    <div class="container px-5">
        <div class="row gx-5 align-items-center justify-content-center p-5">
            <div class="col">
                <div class="my-5 text-center text-xl-center ">
                    <h1 style="color: #009d7d;"class="display-5 fw-bolder mb-2" id="noah1">NOAH'S ARK<br><span id="dc1" style="color: #8f2200;">DOG AND CAT SHELTER</span></h1>
                    <p  class="lead fw-bold mb-5 ">"SOME ANGELS CHOOSE FURS INSTEAD OF WINGS"</p>
                    <div class="my-5 d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-center">
                        <a class="btn btn-success btn-lg px-4 me-sm-4" href="/adoption.php"><i class="fa-solid fa-hands-holding"></i> Adoption</a>
                        <a class="btn btn-success btn-lg px-4 me-sm-4" href="/found.php"><i class="fa-solid fa-camera"></i> Report Stray</a>
                        <a class="btn btn-success btn-lg px-4 me-sm-4" href="#donation"><i class="fa-solid fa-hand-holding-heart"></i> Donation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>





<!--- event revise-->
<div class="container-fluid bg-light py-5 " id="event">

  <div class="container">


        <p class="text-center display-2 fw-bold">Organization Events</p>





        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">

<style>
    @media only screen and (min-width: 768px) {
      /* desktop */
      #theimage{
      width: 60%;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }


  }


  #theimage{

      display: block;
      margin-left: auto;
      margin-right: auto;
    }
    
</style>  


<div class="carousel-inner" id="carousel-inner-custom">

  <?php 
  include 'backend/dbconnect.php';

  try {
      $stmt = $conn->prepare("SELECT * FROM events");
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

      $active = true; // Initialize the active flag

      foreach ($result as $row) {
          // Access columns like $row['column_name']
  ?>

          <div class="carousel-item <?php if($active) echo 'active'; ?>" data-bs-interval="2000">
          <!-- <a href="view-events.php?#<?php echo $row['event_name']; ?>" target="_blank">  -->
            <img src="<?php echo $row['event_img']; ?>" class="d-block" alt="..." id="theimage" height=500px;>
          <!-- </a> -->
            <div class="carousel-caption d-none d-md-block">
              <h5><?php echo $row['event_name']; ?></h5>
              <p><?php echo $row['event_desc']; ?></p>
            </div>
          </div>

  <?php
          $active = false; // Set active to false after the first item
      }
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
  ?>

</div>

<div class="carousel-indicators">

<?php
include 'backend/dbconnect.php';

try {
    $stmt = $conn->prepare("SELECT * FROM events WHERE is_archive = 0");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Initialize a variable to track the active indicator
    $active = true;

    foreach ($result as $key => $row) {
        // Access columns like $row['column_name']
        $data_slide_to = $key;

        // Output the carousel indicator
        echo '<button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="' . $data_slide_to . '"';

        if ($active) {
            echo ' class="active"';
            $active = false;
        }

        echo ' aria-label="Slide ' . ($key + 1) . '"></button>';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

</div>

<style>
  #carousel-control-prev-custom {
    padding-left: 0 !important;
    padding-right: 0 !important;
  }

  


  #carousel-control-next-custom {
    padding-left: 0 !important;
    padding-right: 0 !important;
  }
  
</style>


<button id="carousel-control-prev-custom" class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button id="carousel-control-next-custom" class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<!-- Bootstrap and other scripts -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<!-- Link the JavaScript file -->
<script src="carousel.js"></script>

<!--- event revise-->
<!--- event revise-->
<!-- 
<div class="album py-5 bg-light">
<p class="text-center fs-1">Organization Events</p>
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">
     
            <img class="bd-placeholder-img card-img-top" 
            width="100%" 
            height="225" 
            role="img" src="/assets/meow-land.png" alt="...">

            <div class="card-body">
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-secondary">See More</button>
             
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
          </div>
        </div>
       
        <div class="col">
          <div class="card shadow-sm">
     
            <img class="bd-placeholder-img card-img-top" 
            width="100%" 
            height="225" 
            role="img" src="/assets/noah_teddy.jpg" alt="...">

            <div class="card-body">
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-secondary">See More</button>
             
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
          </div>
        </div>
 
        <div class="col">
          <div class="card shadow-sm">
     
            <img class="bd-placeholder-img card-img-top" 
            width="100%" 
            height="225" 
            role="img" src="/assets/noah_pet_collar.jpg" alt="...">

            <div class="card-body">
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-secondary">See More</button>
             
                </div>
                <small class="text-muted">9 mins</small>
              </div>
            </div>
          </div>
        </div>

      
       
        <p>See more Events..</p>
      </div>
    </div>
  </div>
 -->

<!--- event revise-->




<!--- about us revise-->

<div class="album py-5 px-2 bg-white" id="about">
<p class="text-center display-2 fw-normal">About Us</p>
    <div class="container text-center p-2">

    <p>Noah's Ark Dog and Cat Shelter is a non-profit organization that is located in Mabalacat City, </p>
    <p> Pampanga that shelter stray cats and dogs in Mabalacat Pampanga. Noah's Ark Dog and Cat Shelter also rescue sickly, </p>
    <p>injured and abandoned pets around Mabalacat.</p>
       
        
  
    </div>
  </div>
<!--- about us revise-->



<!--- faq revise-->

<div class="album py-5 px-2 bg-light" id="faq">
<p class="text-center display-2 fw-normal">FAQ</p>
    <div class="container text-center p-1">

        <div class="accordion accordion-flush" id="accordionFlushExample">
        
        
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                How can I adopt a stray pet?
              </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">To adopt a pet, kindly copy the pet's information and reach out to us via messenger app or visit Noah's Ark Dog and Cat Shelter in Tabun, Mabalacat City.
                
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                Is there a requirement for me to adopt a pet?
              </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">A interview and a house check is required before a pet is release to your care. This will acts an assurance to us to make sure that the pet will receive all the love and care they needed.</div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
              How can I donate ?
              </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
              <div class="accordion-body">Noah's Ark welcomes cash donations via BDO, BPI, Metrobank, PayPal, or Gcash. We also appreciate donations of pet food, vaccines, and medicines for our stray pets. Message us at https://m.me/Noahsarkdogandcatshelter to help </div>
            </div>
          </div>
    </div>
    </div>
  </div>
<!--- faq revise-->



<!--- donation revise-->

<div class="album py-5 bg-white" id="donation">
    <p class="text-center display-2 fw-normal">Donations</p>
    <div class="container">
      <p class="p-2">Connecting Hearts, Creating Homes: Where Every Pet Finds Love. For those who want to donate to our humble abode, you may send the donation to the accounts below.</p>
      <div class="row">
        <div class="col-6 col-sm-4 col-md-2">
          <!-- Donation 1: BDO -->
          <div class="card h-100 shadow-sm">
            <img class="card-img-top bg-primary p-4" src="/assets/BDO.png" alt="BDO">
            <div class="card-body">
              <p class="card-text">Ma. Leah D. Ibuna</p>
              <p class="card-text">007730224485</p>
            </div>
          </div>
        </div>
        <div class="col-6 col-sm-4 col-md-2">
          <!-- Donation 2: PayPal -->
          <div class="card h-100 shadow-sm">
            <img class="card-img-top bg-white p-4" src="assets/paypal.png" alt="PayPal">
            <div class="card-body">
              <p class="card-text">Leah Santos</p>
              <p class="card-text">425-742-5907928</p>
            </div>
          </div>
        </div>
        <div class="col-6 col-sm-4 col-md-2">
          <!-- Donation 3: BPI -->
          <div class="card h-100 shadow-sm">
            <img class="card-img-top bg-danger p-4" src="/assets/BPI.png" alt="BPI">
            <div class="card-body">
              <p class="card-text">Ma. Leah D. Ibuna</p>
              <p class="card-text">2429367673</p>
            </div>
          </div>
        </div>
        <div class="col-6 col-sm-4 col-md-2">
          <!-- Donation 4: GCash -->
          <div class="card h-100 shadow-sm">
            <img class="card-img-top bg-primary p-4" src="assets/GCASH.png" alt="GCash">
            <div class="card-body">
              <p class="card-text">Ma. Leah D. Ibuna</p>
              <p class="card-text">09338240324</p>
            </div>
          </div>
        </div>
        <div class="col-6 col-sm-4 col-md-2">
          <!-- Donation 5: Metrobank -->
          <div class="card h-100 shadow-sm">
            <img class="card-img-top bg-white p-4" src="assets/metrobank.png" alt="Metrobank">
            <div class="card-body">
              <p class="card-text">Leah Santos</p>
              <p class="card-text">425-742-5907928</p>
            </div>
          </div>
        </div>
        <div class="col-6 col-sm-4 col-md-2">
          <!-- Donation 6: GCash -->
          <div class="card h-100 shadow-sm">
            <img class="card-img-top bg-primary p-4" src="assets/GCASH.png" alt="GCash">
            <div class="card-body">
              <p class="card-text">Reynald Farala</p>
              <p class="card-text">09338240359</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

       
<!--- donation revise-->



<footer class="text-muted py-5 p-2 bg-dark ">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#" class="text-decoration-none text-white">Back to top</a>
    </p>
    <p><i class="fa-solid fa-location-crosshairs "></i>  <a href="https://maps.app.goo.gl/hKXsfktyGRLeHM5R7" class="text-white text-decoration-none">Sitio Irung Brgy. Tabun, Mabalacat, Philippines</a></p>
          <p><i class="fa-solid fa-phone"></i>  <a href="tel:0933 824 0324" class="text-decoration-none text-white">0933 824 0324</a></p>
          <p><i class="fa-regular fa-envelope"></i>  <a href = "mailto: leahibuna@yahoo.com" class="text-white text-decoration-none">Leahibuna@yahoo.com</a></p>
          <p><i class="fa-brands fa-facebook-f"></i>  <a href="https://www.facebook.com/Noahsarkdogandcatshelter" class="text-decoration-none text-white">Noah's Ark Dog and Cat Shelter</a></p>
    </div>
</footer>



  <!-- Contact Us
  <div class="container bg-light mt-3" id="contact">
    <h1 class="text-center py-3">Contact Us</h1>
    <div class="container row">
      <div class="col-sm">
        <div class="leftside ">
          <p><i class="fa-solid fa-location-crosshairs"></i>  <a href="https://maps.app.goo.gl/hKXsfktyGRLeHM5R7">Sitio Irung Brgy. Tabun, Mabalacat, Philippines</a></p>
          <p><i class="fa-solid fa-phone"></i>  <a href="tel:0933 824 0324">0933 824 0324</a></p>
          <p><i class="fa-regular fa-envelope"></i>  <a href = "mailto: leahibuna@yahoo.com">Leahibuna@yahoo.com</a></p>
          <p><i class="fa-brands fa-facebook-f"></i>  <a href="https://www.facebook.com/Noahsarkdogandcatshelter">https://fb.com/Noahsarkdogandcatshelter</a></p>
      </div>
    
  

    </div>
 -->
  
    <?php 
  include 'components/footer.php'

  ?>


 

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
