<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Event List</title>

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
      <th scope="col">Event Name</th>
      <th scope="col">Event ID</th>
    
      <th scope="col">Event Image</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>




  <?php


include 'backend/dbconnect.php';


if(isset($_GET['search'])){
  $keyword = '%' . $_GET['search'] . '%';
  $stmt = $conn->prepare("SELECT `event_id`, `event_name`, `event_desc`, `event_date`, `event_time`, `event_location`, `event_img`
  FROM events
  WHERE (event_name LIKE '$keyword'
     OR event_desc LIKE '$keyword'
     OR event_date LIKE '$keyword'
     OR event_id LIKE '$keyword'
     OR event_location LIKE '$keyword'
     OR event_time LIKE '$keyword')
     AND is_archive = 1");
  $stmt->execute(); // Execute the statement first.
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

}else{
  $stmt = $conn->prepare("SELECT * FROM `events` WHERE is_archive = 1");
  $stmt->execute(); // Execute the statement first.
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}



foreach ($result as $row) {

    ?>

    
<tr>
 
<td><?php echo $row['event_id'];  ?></td>
<td><?php echo $row['event_name'];  ?></td>

      
      <td><img  src="<?php echo $row['event_img'];  ?>" alt="Logo" width="70" height="70" class="d-inline-block align-text-top"></td>
      <td>
        <a href="view-event.php?event_name=<?php echo $row['event_name'] . '&event_desc=' . $row['event_desc'] . '&event_img=' . $row['event_img'] . '&event_date=' . $row['event_date'] . '&event_time=' . $row['event_time'] . '&event_location=' . $row['event_location'] ?>" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i>View</a> 
  <a href="update-event.php?event_id=<?php echo $row['event_id'] ?>" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
        <button type="button" onClick="delete_event(<?php echo $row['event_id'] ?>)" class="btn btn-secondary btn-md"><i class="fa-solid fa-rotate-right"></i> Archive </button>
  
        </td>
      
   
</tr>


<!-- <th scope="col">Action</th>
      <th scope="col">Event Name</th>
      <th scope="col">Event Desc</th>
      <th scope="col">Event Image</th>
      <th scope="col">Event Date</th>
      <th scope="col">Event Time</th>
      <th scope="col">Event Location</th> -->



<?php
}
?>  



    






    <!-- <tr>
        <td>
        <a  href="view-adoption-pet.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View</a>
        <a href="update-adoption-pet.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
        <button type="button" class="btn btn-danger btn-md"><i class="fa-solid fa-trash"></i> Delete</button>
        <button type="button" class="btn btn-secondary btn-md text-white"><i class="fa-solid fa-copy"></i> Copy Link</button>
        </td>
        <td><img  src="assets/dog1.jpg" alt="Logo" width="50" height="50" class="d-inline-block align-text-top"></td>
      <td>143</td>
      <td>16 months</td>
      <td>male</td>
      <td>dog</td>
    </tr>

    <tr>
        <td>
        <a  href="view-adoption-pet.php" class="btn btn-primary btn-md"><i class="fa-solid fa-eye"></i> View</a>
        <a href="update-adoption-pet.php" class="btn btn-success btn-md"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
        <button type="button" class="btn btn-danger btn-md"><i class="fa-solid fa-trash"></i> Delete</button>
        <button type="button" class="btn btn-secondary btn-md text-white"><i class="fa-solid fa-copy"></i> Copy Link</button>

        </td>
        <td><img  src="assets/dog1.jpg" alt="Logo" width="50" height="50" class="d-inline-block align-text-top"></td>
      <td>143</td>
      <td>16 months</td>
      <td>male</td>
      <td>dog</td>
    </tr>

     -->


  
   
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
function delete_event(delete_event) {
    Swal.fire({
        title: 'Are you sure?',
        text: "Unarchive Event #" + delete_event + "?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Unarchive it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Send an AJAX request to delete the user
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "backend/delete_event.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                    
                        Swal.fire({
                            title: 'Unarchived!',
                            text: 'Event has been Unarchive.',
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
            xhr.send("event_id1=" + delete_event);
        }
    })
}
</script>








    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
