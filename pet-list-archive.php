<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Pet List</title>

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

        <script>

        </script>



        <div class="container-fluid overflow-auto">
<table class="table table-bordered text-start text-nowrap overflow-auto">
  <thead>
    <tr>
     <!-- <th scope="col">Action</th>
      <th scope="col">Pet image</th>
      <th scope="col">Pet name</th>
      <th scope="col">Pet owner</th>
      <th scope="col">Pet age (year)</th>
      <th scope="col">Pet Sex</th>
      <th scope="col">Pet type</th> -->
      <th scope="col">Pet ID </th>
      <th scope="col">Name </th>
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
  $stmt = $conn->prepare("SELECT pets.*, users.fullname as pet_owner_name
  FROM pets
  JOIN users ON pets.pet_owner = users.id
  WHERE (pet_name LIKE :keyword
     OR pet_gender LIKE :keyword
     OR pet_birthday LIKE :keyword
     OR pet_id LIKE :keyword
     OR pet_type LIKE :keyword
     OR pet_last_vaccine LIKE :keyword
     OR users.fullname LIKE :keyword
     OR pet_next_vaccine LIKE :keyword)
     AND pets.is_archive = 1");


$stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR); // Bind the parameter

$stmt->execute(); // Execute the statement

$result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the results

}else{
  $stmt = $conn->prepare("SELECT pets.*, users.fullname as pet_owner_name
  FROM pets
  JOIN users ON pets.pet_owner = users.id
  WHERE pets.is_archive = 1");

  $stmt->execute(); // Execute the statement first.
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}



foreach ($result as $row) {
  $birthday = $row['pet_birthday'];
  $today = new DateTime();
  $birthdate = new DateTime($birthday);
  $age = $today->diff($birthdate)->y;
    ?>
<tr>


<td><?php echo $row['pet_id'];  ?></td>
<td><?php echo $row['pet_name'];  ?></td>


<td><img  src="<?php echo $row['pet_img'];  ?>" alt="Logo" width="70" height="70" class="d-inline-block align-text-top"></td>
      
        <td>
        <a href="view-pet.php?pet_name=<?php echo $row['pet_name'] . '&pet_birthday=' . $row['pet_birthday'] . '&pet_age=' . $age . '&pet_last_vaccine=' . $row['pet_last_vaccine'] . '&pet_next_vaccine=' . $row['pet_next_vaccine'] . '&pet_img=' . $row['pet_img']; ?>" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View</a> 
        <a href="update-pet.php?pet_id=<?php echo $row['pet_id'] ?>" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
        <button class="btn btn-secondary btn-md" onClick="delete_pet(<?php echo $row['pet_id']; ?>, '<?php echo $row['pet_img']; ?>')"><i class="fa-solid fa-rotate-right"></i>  Unarchive</button>

        </td>
       
     
      
      
      
    </tr>
<?php
}
?>  
    




    <!--
    <tr>
        <td>
        <a  href="view-pet.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View</a>
        <a href="update-pet.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
        <button type="button" class="btn btn-danger btn-md"><i class="fa-solid fa-trash"></i> Delete</button>

        </td>
        <td><img  src="assets/dog1.jpg" alt="Logo" width="50" height="50" class="d-inline-block align-text-top"></td>
      <td>shernan</td>
      <td>genasky jr pinlac</td>
      <td>16 months</td>
      <td>male</td>
      <td>dog</td>
    </tr>




     <tr>
        <td>
        <a  href="view-pet.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View</a>
        <a href="update-pet.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
        <button type="button" class="btn btn-danger btn-md"><i class="fa-solid fa-trash"></i> Delete</button>

        </td>
        <td><img  src="assets/dog1.jpg" alt="Logo" width="50" height="50" class="d-inline-block align-text-top"></td>
      <td>shernan</td>
      <td>genasky jr pinlac</td>
      <td>16 months</td>
      <td>male</td>
      <td>dog</td>
    </tr>

    <tr>
        <td>
        <a  href="view-pet.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View</a>
        <a href="update-pet.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
        <button type="button" class="btn btn-danger btn-md"><i class="fa-solid fa-trash"></i> Delete</button>
        </td>
        <td><img  src="assets/dog1.jpg" alt="Logo" width="50" height="50" class="d-inline-block align-text-top"></td>
      <td>shernan</td>
      <td>genasky jr pinlac</td>
      <td>16 months</td>
      <td>male</td>
      <td>dog</td>
    </tr>

    <tr>
        <td>
        <a  href="view-pet.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View</a>
        <a href="update-pet.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
        <button type="button" class="btn btn-danger btn-md"><i class="fa-solid fa-trash"></i> Delete</button>

        </td>
        <td><img  src="assets/dog1.jpg" alt="Logo" width="50" height="50" class="d-inline-block align-text-top"></td>
      <td>shernan</td>
      <td>genasky jr pinlac</td>
      <td>16 months</td>
      <td>male</td>
      <td>dog</td>
    </tr> -->
  
  
   
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



function delete_pet(petId, pet_img) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Unarchive pet#" + petId + "?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Unarchive it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Send an AJAX request to delete the pet
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "backend/delete_pet.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                      
                        Swal.fire({
                          title: 'Unarchived!',
                          text: 'Pet has been Unarchived.',
                          icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload(true);
                            }
                        });


                    } else {
                        Swal.fire('Error', 'There was an error deleting the pet.', 'error');
                    }
                }
            };
            // Concatenate both parameters and send them as a single string
            xhr.send("pet_id1=" + petId + "&pet_img=" + pet_img);
        }
    })
}
</script>





<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
