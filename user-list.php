<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>User List</title>

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



<table class="table table-bordered text-start text-nowrap">
  <thead>
    <tr>
    <th scope="col">ID</th>
      <th scope="col">Email Verification</th>
      <th scope="col">Address Verification</th>
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
  $stmt = $conn->prepare("SELECT `id`, `is_role`, `reg_date`, `fullname`, `email`, `address`, `phone_number`, is_archive, is_email_verified, is_acount_verified
  FROM users
  WHERE (id LIKE :keyword OR fullname LIKE :keyword OR email LIKE :keyword OR address LIKE :keyword OR phone_number LIKE :keyword) 
  AND is_archive = 0");

  $keyword = "%$keyword%"; // Assuming $keyword is a variable that holds your search term
  $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);


}else{


  //to not show admin
  $stmt = $conn->prepare("SELECT * FROM `users` WHERE is_role != 'admin' AND is_archive = '0'");
  $stmt->execute(); // Execute the statement first.
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

}


foreach ($result as $row) {
  //PET OWNER TO BE COUNT
  $owner = $row['id'];
  //echo $owner;
  $stmt = $conn->prepare("SELECT COUNT(*) FROM pets WHERE pet_owner = :owner");
  $stmt->bindParam(':owner', $owner, PDO::PARAM_STR); // Bind the parameter
  $stmt->execute();
  $count = $stmt->fetchColumn();
  ?>

<tr>
  
      <td><?php echo $row['id'];  ?></td>
     

      

      
      <td><?php 
      if($row['is_email_verified']==1){
        echo 'Verified <i class="fa-solid fa-check"></i>';
      }else{
        echo 'Not Verified <i class="fa-solid fa-xmark"></i>';
      }
      ?></td>


<td><?php 
      if($row['is_acount_verified']==1){
        echo 'Verified <i class="fa-solid fa-check"></i>';
      }else{
        echo 'Not Verified <i class="fa-solid fa-xmark"></i>';
      }
      ?></td>


      


      <td>
        <a  href="profile.php?fullname=<?php echo $row['fullname'] . '&address=' . $row['address'] . '&email=' . $row['email'] . '&phone_number=' . $row['phone_number'] . '&pet_count=' . $count ?>" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i></a>
        <a  href="account.php?id=<?php echo $row['id']?>" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i></a>        
        <button type="button" onclick="deleteUser(<?php echo $row['id'] ?>)" class="btn btn-danger btn-md"><i class="fa-solid fa-box-archive"></i> </button>
        </td>


        
</tr>




<?php
}
?>








    <!--<tr>
        <td>
        <a  href="profile.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View</a>
        <a  href="account.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit</a>        
        <button type="button" class="btn btn-danger btn-md"><i class="fa-solid fa-trash"></i> Delete</button>

        </td>
      <td>Jayem t pinlac</td>
      <td>jayem@gmail.com</td>
      <td>malusac samduan pampanga</td>
      <td>0932425524</td>
      <td>4</td>
    </tr>
     <tr>
        <td>
        <a  href="profile.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View</a>
        <a  href="account.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit</a>        
        <button type="button" class="btn btn-danger btn-md"><i class="fa-solid fa-trash"></i> Delete</button>

        </td>
      <td>Jayem t pinlac</td>
      <td>jayem@gmail.com</td>
      <td>malusac samduan pampanga</td>
      <td>0932425524</td>
      <td>4</td>
    </tr>
    <tr>
        <td>
        <a  href="profile.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View</a>
        <a  href="account.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit</a>        
        <button type="button" class="btn btn-danger btn-md"><i class="fa-solid fa-trash"></i> Delete</button>

        </td>
      <td>Jayem t pinlac</td>
      <td>jayem@gmail.com</td>
      <td>malusac samduan pampanga</td>
      <td>0932425524</td>
      <td>4</td>
    </tr>
    <tr>
        <td>
        <a  href="profile.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View</a>
        <a  href="account.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit</a>        
        <button type="button" class="btn btn-danger btn-md"><i class="fa-solid fa-trash"></i> Delete</button>

        </td>
      <td>Jayem t pinlac</td>
      <td>jayem@gmail.com</td>
      <td>malusac samduan pampanga</td>
      <td>0932425524</td>
      <td>4</td>
    </tr>
    <tr>
        <td>
        <a  href="profile.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View</a>
        <a  href="account.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit</a>        
        <button type="button" class="btn btn-danger btn-md"><i class="fa-solid fa-trash"></i> Delete</button>

        </td>
      <td>Jayem t pinlac</td>
      <td>jayem@gmail.com</td>
      <td>malusac samduan pampanga</td>
      <td>0932425524</td>
      <td>4</td>
    </tr>
    <tr>
        <td>
        <a  href="profile.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View</a>
        <a  href="account.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit</a>        
        <button type="button" class="btn btn-danger btn-md"><i class="fa-solid fa-trash"></i> Delete</button>

        </td>
      <td>Jayem t pinlac</td>
      <td>jayem@gmail.com</td>
      <td>malusac samduan pampanga</td>
      <td>0932425524</td>
      <td>4</td>
    </tr>
    <tr>
        <td>
        <a  href="profile.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View</a>
        <a  href="account.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit</a>        
        <button type="button" class="btn btn-danger btn-md"><i class="fa-solid fa-trash"></i> Delete</button>

        </td>
      <td>Jayem t pinlac</td>
      <td>jayem@gmail.com</td>
      <td>malusac samduan pampanga</td>
      <td>0932425524</td>
      <td>4</td>
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


                        
function deleteUser(userId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Archive User " + userId +"?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Archive it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Send an AJAX request to delete the user
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "backend/delete_user.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                 
                        Swal.fire({
                          title: 'Archived!',
                          text: 'User has been Archive.',
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
            xhr.send("id=" + userId);
        }
    })
}
</script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
