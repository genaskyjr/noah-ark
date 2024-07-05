<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Update Adoption Pet</title>

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

    <script src="js/updateAdoptionPetValidation.js"></script>

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

        <!-- content  -->


        <?php
          try {

              $id = $_GET['adoption_number'];

              $stmt = $conn->prepare("SELECT * FROM `adoption_pets` WHERE `adoption_number` = $id");
              $stmt->execute();
              
              // Fetch all rows as associative arrays
              $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
              
              foreach ($result as $row) {
                  // Access columns like $row['column_name']
                  //echo $row['pet_id'] . " " . $row['pet_name'] . "<br>";
              }
          }
          catch(PDOException $e) {
              echo "Error: " . $e->getMessage();
          }
          ?>



        <div class="container text-center">
            <img id="logo" src="<?php echo $row['adoption_image'] ?>" alt="Logo" width="150" height="150" class="mt-3 d-inline-block align-text-top rounded-circle">

        </div>
        

                  <!-- start -->
                  <form id="update_adoption_pet_form" method='post' enctype=multipart/form-data>
                        <label>Adoption Pet Number</label>
                        <input value="<?php echo $row['adoption_number'] ?>" type="text" name="adoption_number" id="adoption_number" class="bg-light form-control my-1 mb-3 py-2" placeholder="Enter pet number" readonly/>
                        
                        <label for="adoption_nickname">Pet's Nickname<span class="text-danger">*<span></label>
    <input value="<?php echo $row['adoption_nickname'] ?>" type="text" name="adoption_nickname" id="adoption_nickname" class="form-control my-1 mb-3 py-2" placeholder="Enter Pet’s Nickname" required/>

              

                        <label>Sex<span class="text-danger">*<span></label>
                        <select id="adoption_gender" class="form-select form-control my-1 mb-3 py-2" aria-label="Default select example" name="adoption_gender">
                          <?php
                          $genderOptions = ['Male', 'Female']; // Define the available gender options

                          foreach ($genderOptions as $option) {
                            $isSelected = ($option == $row['adoption_gender']) ? 'selected' : ''; // Check if option matches pet's gender
                            echo "<option value='$option' $isSelected>$option</option>";
                          }
                          ?>
                        </select>

                        

                    
                      
                        <label>Date of Rescue<span class="text-danger">*<span></label>
                        <input type="date" value="<?php echo $row['adoption_recued'] ?>" name="adoption_recued" id="adoption_recued" class="form-control my-1 mb-3 py-2" placeholder="Enter your pet birthday" required/>
                        
                


                        <label>Type<span class="text-danger">*<span></label>
                        <select id="adoption_type" class="form-select form-control my-1 mb-3 py-2" aria-label="Default select example" name="adoption_type">
                            <?php
                            $genderOptions = ['Dog', 'Cat']; // Define the available gender options

                            foreach ($genderOptions as $option) {
                                $isSelected = ($option == $row['adoption_type']) ? 'selected' : ''; // Check if option matches pet's gender
                                echo "<option value='$option' $isSelected>$option</option>";
                            }
                            ?>
                        </select>




                        <label for="file">Adoption Picture of Pet<span class="text-danger">*<span></label>
<input name="file" type="file" class="form-control mb-3 py-2 my-1" id="file" accept="image/*" aria-describedby="inputGroupFileAddon04" aria-label="Upload">


    <img id="blah" src="#" alt="Preview" width="150" class="my-1 mb-3 py-2" height="150" style="display:none;">



                        <div class="text-left mt-3">
                            <button type="submit" class="btn btn-success">Update Pet’s Profile</button>
                        </div>

                        <div class="text-start mt-3">
    <p class="fs-6"><span class="text-danger">*</span> Required Fields</p>
    </div>

                  </form>
                <!-- start -->

        




     
      </div>
      <!-- content end -->




  </div>


<?php 
include 'components/footer.php'

?>



<script>
$(document).ready(function() {
    $('#update_adoption_pet_form').on('submit', function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        console.log(formData);

        $.ajax({
            url: 'backend/update-adoption-pet.php', // Replace with the URL to your upload script
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response.message);

                if (response.status === 1) {
                    Swal.fire({
                        title: 'Update adoption pet',
                        text: 'Update successfully',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload(true);
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'No Action',
                        icon: 'error',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload(true);
                        }
                    });
                }
            },
            error: function(error) {
                console.log(error.statusText);
            }
        });
    });
});
</script>






<script> 
document.getElementById('file').onchange = evt => {
  document.getElementById('blah').style.display = 'block';

  const [file] = evt.target.files;
  if (file) {
    const blah = document.getElementById('blah');
    blah.src = URL.createObjectURL(file);
  }
}
</script>





<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
