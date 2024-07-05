<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Adoption</title>

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


      <div class="container-fluid gx-0">
      <div  class="container text-start gx-0 p-1">
               
     
<div id="filter"class="row g-2 g-md-3 row-cols-2 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xl-5 row-cols-xxl-6">
   
   
      <div class="col">
        <select name="pet_status" class="form-select" aria-label="Select pet status">
            <option selected disabled hidden>Pet Status*</option>
            <option value="Adoptable">Adoptable</option>
            <option value="Quarantine">Quarantine</option>
        </select>
    </div>
 

</div>


<div id="petList" class="row g-2 g-md-3 mt-1 row-cols-2 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4 row-cols-xl-5 row-cols-xxl-6"></div>

<script>



    // Function to display pets from the retrieved data
    function displayPets(data) {
        const petListDiv = document.getElementById('petList');

        petListDiv.innerHTML = '';

        if (data && data.status === 'success' && data.data) {
            const pets = data.data;
            // Loop through each pet data object and create card divs
            pets.forEach(pet => {
                const petCard = `
                    <div class="col">
                        <div class="card bg-light">
                            <img src="${pet.adoption_image}" class="card-img-top" alt="..." height="150px" width="150px">
                            <div class="card-body text-center">
                                <h5 class="card-title">
                                    <div class="d-flex flex-column align-items-center">
                                        <span class="fw-bold">${pet.adoption_nickname}</span>
                                        <span class="text-muted" style="opacity: 0.5;">Pet#${pet.adoption_number}</span>
                                        ${(pet.quarantine_day > 0) ? `<p class="fs-6 text-muted">(Quarantine ${Math.floor(pet.quarantine_day / 86400)} days)</p>` : ''}
                                    </div>
                                </h5>
                                <a href="view-adoption-pet.php?adoption_number=${pet.adoption_number}&adoption_gender=${pet.adoption_gender}&adoption_recued=${pet.adoption_recued}&adoption_type=${pet.adoption_type}&adoption_image=${pet.adoption_image}&quarantine_day=${pet.quarantine_day}&adoption_nickname=${pet.adoption_nickname}" class="btn btn-primary btn-md">
                                    <i class="fa-solid fa-eye"></i> View
                                </a>
                            </div>
                        </div>
                    </div>
                `;
                petListDiv.innerHTML += petCard; // Append each pet card to the petListDiv
            });
        } else {
            petListDiv.innerText = 'No valid data received.';
        }
    }




url = 'https://rvpn.site/backend/adoptionjson.php';
fetchData(url);
document.getElementById('filter').addEventListener('change', function(event) {
        event.preventDefault(); // Prevent form submission for demonstration
        
        // Get selected values from dropdowns
        const status = document.querySelector('select[name="pet_status"]').value;

        // You can perform actions with the selected values here, for example:
        console.log('Selected Status:', status);

        if (status === 'Adoptable') {
          url = 'https://rvpn.site/backend/adoptionjson.php?status=' + status;
          fetchData(url);

        } else if(status === 'Quarantine') {
          url = 'https://rvpn.site/backend/adoptionjson.php?status=' + status;
          fetchData(url);
        }else{
          fetchData(url);
        }

      
});


function fetchData(url) {
    fetch(url)
        .then(response => response.json()) // Parse the JSON response
        .then(data => {
            displayPets(data); // Call function to display pets
            console.log(data);
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            document.getElementById('petList').innerText = 'Error fetching data. Please try again later.';
        });
}

// Call the fetchData function with the URL
fetchData('https://rvpn.site/backend/adoptionjson.php');


</script>

       




        </div>
</div>

      </div>
      <!-- content end -->
  </div>

 </div>


<?php 
include 'components/footer.php';
?>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>

  </body>
</html>
