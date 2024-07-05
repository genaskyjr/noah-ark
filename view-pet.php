<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>View Pet</title>

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


      <div id="content" class="m-3 bg-white container content text-center border-top border-success border-3 rounded-1">
    

      <?php
        include 'components/breadcrumb.php'
      ?>

    
<div class="container text-center">

            
<img id="logo" src="<?php echo $_GET['pet_img']?>" alt="Logo" width="150" height="150" class="mt-3 d-inline-block align-text-top rounded-circle">

<h4 class="text-center mt-3"><?php echo $_GET['pet_name']?></h4>
<!-- <p class="text-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolores dolor nulla voluptas culpa, quis dolorem! Repudiandae perferendis reiciendis exercitationem libero illo pariatur animi, provident, fugit accusantium cupiditate modi accusamus unde.&hearts; </p> -->
<!--table -->

<table class="table table-bordered text-start">

    <thead>
        <tr>
          <th>Information</th>
          <th>Data</th>
        </tr>
      </thead>
      <tbody>
        <tr class="">
          <td >Name</td>
          <td><?php echo $_GET['pet_name']?></td>
        </tr>
        <tr class="">
          <td >Birthday</td>
          <td><?php echo $_GET['pet_birthday']?></td>
        </tr>
        <tr class="">
          <td >Sex</td>
          <td><?php echo $_GET['pet_gender']?></td>
        </tr>
        <tr class="">
          <td >Type</td>
          <td><?php echo $_GET['pet_type']?></td>
        </tr>
        <tr class="">
          <td >Age (Year)</td>
          <td><?php echo $_GET['pet_age']?></td>
        </tr>
        <tr class="">
          <td >Last Vaccinated</td>
          <td><?php 
          if($_GET['pet_last_vaccine']=='0000-00-00'){
            echo 'N/A';
          }else{
            echo $_GET['pet_last_vaccine'];
          }
          ?></td>
        </tr>
        <tr class="">
          <td >Next Vaccination</td>
          <td><?php 
          if($_GET['pet_next_vaccine']=='0000-00-00'){
            echo 'N/A';
          }else{
            echo $_GET['pet_next_vaccine'] . ' | We will remind you in email';
          }
          ?></td>
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




    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
