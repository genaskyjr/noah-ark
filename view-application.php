<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>View Application</title>

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

 

<?php 

include 'backend/dbconnect.php';

$who = $_GET['application_number'];

$stmt = $conn->prepare("SELECT 
adopt_application.id AS id,
adopt_application.adoption_number AS petnumber,
adopt_application.fulladdress AS fulladdress,
adopt_application.reason AS reason,
adopt_application.howmany AS count,
adopt_application.user_id_picture AS useridpic,
users.fullname AS fullname,
users.email AS email,
users.address AS barangay,
users.phone_number AS phone,
adoption_pets.adoption_nickname AS nickname,
adoption_pets.adoption_image AS image
FROM 
adopt_application
JOIN 
adoption_pets ON adopt_application.adoption_number = adoption_pets.adoption_number
JOIN 
users ON adopt_application.user_id = users.id
WHERE 
  adopt_application.id = '$who';

");
  $stmt->execute(); // Execute the statement first.
  $result = $stmt->fetch(PDO::FETCH_ASSOC);



?>



<img id="logo" src="../uploads/adoption_pets/admin.noahsark@rvpn.site/images_20231115121403.jpg" alt="Logo" width="150" height="150" class="text-center mt-3 d-inline-block align-text-top rounded-circle">

<h4 class="text-center mt-3">Pet #<?php echo $result['petnumber']?>

<span class="text-muted">(<?php echo $result['nickname'];?>)</span>


</h4> 




<!-- 
<a href="https://m.me/153237431214823" class="text-start btn btn-primary btn-md" target="_blank">
    <i class="fab fa-facebook-messenger"></i>
    Go to Noah's Ark Dog and Cat Shelter
</a> -->





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
          <td >Application Number</td>
          <td><?php echo $result['id']; ?></td>
        </tr>
        <tr class="">
          <td >Email</td>
          <td><?php echo $result['email']; ?></td>
        </tr>
        <tr class="">
          <td > Barangay</td>
          <td><?php echo $result['barangay']; ?></td>
        </tr>
        <tr class="">
          <td >Phone Number</td>
          <td><?php echo $result['phone']; ?></td>
        </tr>
        <tr class="">
          <td >Full Address</td>
          <td><?php echo $result['fulladdress']; ?></td>
        </tr>
        <tr class="">
          <td >Pet Count</td>
          <td><?php echo $result['count']; ?></td>
        </tr>
        <tr class="">
          <td >Reason for Adopting</td>
          <td><?php echo $result['reason']; ?></td>
        </tr>
        <tr class="">
          <td >Identification Card</td>
          <td><img src="<?php echo $result['useridpic']; ?>" class="img-fluid w-25" alt="..."></td>
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
