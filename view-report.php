<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Profile</title>

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

    
       <h4 class="text-center mt-3">Report #<?php echo $_GET['reportnumber']; ?></h4>
       
       <!--table -->
       <table class="table table-bordered text-start ">

     
    
           <thead>
             <tr>
               <th>Information</th>
               <th>Data</th>
             </tr>
           </thead>
           <tbody>
             <tr>

             <!--
               https://rvpn.site/view-report.php?
               reportnumber=93&
               reportdaytime=2023-11-04&
               image=../uploads/reports/user@gmail.com/testmona_20231104093314.jpg&
               location=https://www.google.com/maps/dir//14.989119,120.620&
               notes=black%20astray&
               reporter_name=marvin%20luquia&
               reporter_email=user@gmail.com&
               reporter_number=Dau
              -->
             <td>Report Number</td>
               <td><?php echo $_GET['reportnumber']; ?></td>
             </tr>
             <tr>
               <td>Reported Date</td>
               <td><?php echo $_GET['reportdaytime']; ?></td>
             </tr>
             <tr>
               <td>Stray Image</td>
               <td><img  src="<?php echo $_GET['image']; ?>" alt="Logo" width="50" height="50" class="d-inline-block align-text-top"></td>
             </tr>
             <tr>
               <td>Stray Location</td>
               <td><a href="<?php echo $_GET['location']; ?>" target="_blank"><?php echo $_GET['location']; ?></a></td>


             </tr>
             <tr>
               <td>Reporter Notes</td>
               <td><?php echo $_GET['notes']; ?></td>
             </tr>
             <tr>
               <td>Reporter Full Name</td>
               <td><?php echo $_GET['reporter_name']; ?></td>
             </tr>
             <tr>
               <td>Reporter Email</td>
               <td><?php echo $_GET['reporter_email']; ?></td>
             </tr>
             <tr>
               <td>Reporter Number</td>
               <td><?php echo $_GET['reporter_number']; ?></td>
             </tr>
           </tbody>

      
         </table>
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
