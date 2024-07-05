<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>View Adoption Pet</title>

    <!--bootstrap 5.2.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!--font -->
    <link href="https://fonts.cdnfonts.com/css/helvetica-neue-55" rel="stylesheet">
    <!--homepage css -->
    <link rel="stylesheet" href="css/custom.css">
    <!--icon -->
    <script src="https://kit.fontawesome.com/c3cf7a82ce.js" crossorigin="anonymous"></script>
    <!--jquery cdn -->
    <script
    src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

    

  </head>
  <body>
<script src="js/zoom.js"></script>


<?php 
  include 'components/nav.php';
  include 'components/navbar.php';
?>


  

  

    <?php 
    include 'components/sidebar.php'
    ?>
     


      <!-- content start -->


      <div id="content" class="m-3 bg-white container content border-top border-success border-3 rounded-1">
    

      <?php
        include 'components/breadcrumb.php'
      ?>

    
<div class="container text-center">

            
<img id="logo" src="<?php echo $_GET['adoption_image']; ?>" alt="Logo" width="150" height="150" class="text-center mt-3 d-inline-block align-text-top rounded-circle">


<h4 class="text-center mt-3"><?php echo $_GET['adoption_nickname']; ?><br><span class="text-muted">
  (Pet #<?php echo $_GET['adoption_number'];?>)</span></h4>


 


<?php 
if (isset($_GET['quarantine_day']) && $_GET['quarantine_day'] > 0) {
    ?>
    <p class="text-center">I’m not ready for adoption yet, please give me some time to be your Campawnion!</p>
 
    <?php
} else {
    ?>
    <p class="text-center">If the pet is available for adoption, what text should be here?</p>
    <a href="adoption-form.php?adoption_number=<?php echo $_GET['adoption_number'] ?>&adoption_nickname=<?php echo $_GET['adoption_nickname'] ?>" class="text-start btn btn-primary btn-md">


    <i class="fa-solid fa-paw"></i>
        Form adoption for Pet #<?php echo $_GET['adoption_number']; ?>
    </a>
    <?php
}
?>




<!-- 
<a href="https://m.me/153237431214823" class="text-start btn btn-primary btn-md" target="_blank">
    <i class="fab fa-facebook-messenger"></i>
    Go to Noah's Ark Dog and Cat Shelter
</a> -->





<script>
function copyButton() {
    var urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('adoption_number')) {
        var petId = urlParams.get('adoption_number');

        navigator.clipboard.writeText(petId)
            .then(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Copied!',
                    text: 'The pet #' + petId + ' ID has been copied to the clipboard.',
                    timer: 1700,
                    showConfirmButton: false
                });
            })
            .catch(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong while copying the pet ID.'
                });
            });
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No pet ID found in the URL.'
        });
    }

    
}
</script>





<!--table -->





<table class="table table-bordered text-start mt-3">

    <thead>
        <tr>
          <th>Information</th>
          <th>Data</th>
        </tr>
      </thead>
      <tbody>
        <tr class="">
          <td >Sex</td>
          <td><?php echo $_GET['adoption_gender']; ?></td>
        </tr>
        <tr class="">
          <td > Type</td>
          <td><?php echo $_GET['adoption_type']; ?></td>
        </tr>
        <tr class="">
          <td >Date of Rescue</td>
          <td><?php echo $_GET['adoption_recued']; ?></td>
        </tr>
      </tbody>



  </table>




</div>


      </div>
      <!-- content end -->




  </div>


<?php 
include 'components/footer.php'

?>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
