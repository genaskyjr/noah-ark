<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Adoption Pet List</title>

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

    
        <!-- content start content ahaha -->

      
        <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand"></a>
            <form class="d-flex" method="get">
              <input value="<?php 
              
              if(isset($_GET['search'])){
                echo $_GET['search'];
              }
              
              ?>" name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
        </nav>


        <div class="container-fluid overflow-auto">
<table class="table table-bordered text-start text-nowrap overflow-auto">
  <thead>
    <tr>
    
      <th scope="col">Pet Nickname</th>
      <th scope="col">Pet Number</th>
      
      <th scope="col">Gender</th>
      <th scope="col">Rescued Date</th>
      <th scope="col">Pet Type</th>
      
      <th scope="col">Image</th>
      <th scope="col">Action</th>
      
      
      

    </tr>
  </thead>
  <tbody>




  <?php


//echo $_SESSION['fullname'];
$current_user = $_SESSION['fullname'];
include 'backend/dbconnect.php';

if(isset($_GET['search'])){
  $keyword = '%' . $_GET['search'] . '%';
  
  $stmt = $conn->prepare("SELECT `adoption_number`, `adoption_gender`, `adoption_recued`, `adoption_type`, `adoption_image`, `is_archive`, adoption_nickname
  FROM adoption_pets
  WHERE (adoption_number LIKE :keyword OR adoption_gender LIKE :keyword OR adoption_recued LIKE :keyword OR adoption_type LIKE :keyword OR adoption_nickname LIKE :keyword)
  AND is_archive = 0");

// Assuming $keyword is a variable that holds your search term
$keyword = "%$keyword%"; // Adding '%' for wildcard search
$stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$stmt->execute();


  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  

}else{
  $stmt = $conn->prepare("SELECT * FROM `adoption_pets` WHERE is_archive = 0");
  $stmt->execute(); // Execute the statement first.
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}




foreach ($result as $row) {

    ?>

<tr>
<td><?php echo $row['adoption_nickname'];  ?></td>
<td><?php echo $row['adoption_number'];  ?></td>
<td><?php echo $row['adoption_gender'];  ?></td>
<td><?php echo $row['adoption_recued'];  ?></td>
<td><?php echo $row['adoption_type'];  ?></td>


<td><img  src="<?php echo $row['adoption_image'];  ?>" alt="Logo" width="80" height="80" class="d-inline-block align-text-top"></td>
      

        <td>
    <a href="view-adoption-pet.php?adoption_number=<?php echo $row['adoption_number'] . '&adoption_gender=' . $row['adoption_gender'] . '&adoption_recued=' . $row['adoption_recued'] . '&adoption_type=' . $row['adoption_type'] . '&adoption_image=' . $row['adoption_image'] . '&adoption_nickname=' . $row['adoption_nickname']; ?>" class="btn btn-primary btn-md">
        <i class="fa-solid fa-eye"></i> View
    </a> 
    <a href="update-adoption-pet.php?adoption_number=<?php echo $row['adoption_number']; ?>" class="btn btn-success btn-md">
        <i class="fa-solid fa-pen-to-square"></i> Edit
    </a>
    <button type="button" onClick="delete_adoption_pet(<?php echo $row['adoption_number']; ?>)" class="btn btn-danger btn-md">
        <i class="fa-solid fa-box-archive"></i> Archive
    </button>
</td>

     
      
      
      


</tr>



<?php
}
?>  



    






    
  
   
  </tbody>
</table>
</div>




        <!-- content start content ahaha -->
      </div>
      <!-- content end -->




  </div>


<?php 
include 'components/footer.php'

?>


<script>


function delete_adoption_pet(delete_adoption_pet) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'Archive adoption pet#' + delete_adoption_pet + '?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Archive it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Send an AJAX request to delete the user
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "backend/delete_adoption_pet.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        Swal.fire({
                          title: 'Archived!',
                          text: 'Adoption pet has been Archived.',
                          icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload(true);
                            }
                        });


                    } else {
                        Swal.fire('Error', 'There was an error deleting the user.', 'error');
                    }
                }
            };
            xhr.send("adoption_number=" + delete_adoption_pet);
        }
    })
}
</script>








    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
