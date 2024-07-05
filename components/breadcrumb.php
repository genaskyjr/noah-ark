
<?php
// Check if the HTTP_REFERER is set and not empty
if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
    // Use PHP to generate a back button that redirects to the previous page
    ?>


    <?php





$current_page = basename($_SERVER['PHP_SELF']);


if($current_page=="profile.php"){

    ?>
    
    <div class="container text-muted text-start gx-0 p-1">
    Profile
    </div>

    <?php

   
}


if($current_page=="profile1.php"){
    ?>
    
    <div class="container text-muted text-start gx-0 p-1">
    
        Dashboard
    </div>

    <?php
}


if($current_page=="mypets.php"){
    ?>
    <!-- <div class="container text-muted text-start gx-0 p-1">
    
    My Pets
    </div> -->

    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

 

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">My Pets</li>
  </ol>
</nav>


    <?php
  

}


if($current_page=="application-list.php"){
  ?>
  <!-- <div class="container text-muted text-start gx-0 p-1">
  
  My Pets
  </div> -->

  <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
<ol class="breadcrumb">
  <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>



  <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Application List</li>
</ol>
</nav>


  <?php


}



if($current_page=="image-classification.php"){
  ?>
  <!-- <div class="container text-muted text-start gx-0 p-1">
  
  My Pets
  </div> -->

  <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
<ol class="breadcrumb">
  <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>



  <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Image Classification</li>
</ol>
</nav>


  <?php


}



if($current_page=="adoption-form.php"){
  ?>
  <!-- <div class="container text-muted text-start gx-0 p-1">
  
  My Pets
  </div> -->

  <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
<ol class="breadcrumb">
  <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>



  <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Adoption Form</li>
</ol>
</nav>


  <?php


}




if($current_page=="addpet.php"){

    ?>

    
    <!-- <div class="container text-muted text-start gx-0 p-1">
       Add Pets
    </div> -->
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

 

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Add Pets</li>
  </ol>
</nav>

    <?php



    }



    if($current_page=="view-application.php"){
      ?>
     <!-- <div class="container text-muted text-start gx-0 p-1">
         Adoption Pets
      </div>
   -->
  
   <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>
  
      <li class="breadcrumb-item active gx-0 p-1" aria-current="page">View application</li>
    </ol>
  </nav>
  
      <?php
  }




if($current_page=="adoption.php"){
    ?>
   <!-- <div class="container text-muted text-start gx-0 p-1">
       Adoption Pets
    </div>
 -->

 <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Adoption Pets</li>
  </ol>
</nav>

    <?php
}


if($current_page=="found.php"){
    ?>
    <!-- <div class="container text-muted text-start gx-0 p-1">
       Report Stray
    </div> -->

    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Report Stray</li>
  </ol>
</nav>

    <?php
}


if($current_page=="account.php"){
    ?>
    <!-- <div class="container text-muted text-start gx-0 p-1">
       My Account
    </div> -->
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Edit Account</li>
  </ol>
</nav>

    <?php
}


if($current_page=="view-pet.php"){
    ?>
    <!-- <div class="container text-muted text-start gx-0 p-1">
       View Pet
    </div> -->

    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">View Pet</li>
  </ol>
</nav>

    <?php
    
}

if($current_page=="update-pet.php"){
    ?>
    <!-- <div class="container text-muted text-start gx-0 p-1">
       Update Pet
    </div> -->
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Update Pet</li>
  </ol>
</nav>

 <?php
}

if($current_page=="user-list.php"){
    ?>
    <!-- <div class="container text-muted text-start gx-0 p-1">
       User List
    </div> -->
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">User List</li>
  </ol>
</nav>
    <?php
}

if($current_page=="pet-list.php"){
    ?>
    <!-- <div class="container text-muted text-start gx-0 p-1">
       Pet List
    </div> -->
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Pet List</li>
  </ol>
</nav>
    <?php
}

if($current_page=="adoption-pet-list.php"){
    ?>
    <!-- <div class="container text-muted text-start gx-0 p-1">
        Adoption Pet List
    </div> -->
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Adoption Pet List</li>
  </ol>
</nav>

    <?php
}


if($current_page=="report-astray-list.php"){
    ?>
    <!-- <div class="container text-muted text-start gx-0 p-1">
        Stray Reports
    </div> -->

    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Stray Reports</li>
  </ol>
</nav>

    <?php
}


if($current_page=="view-report.php"){
    ?>
    <!-- <div class="container text-muted text-start gx-0 p-1">
        View Report
    </div> -->
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">View Report</li>
  </ol>
</nav>
    <?php
}

if($current_page=="report-list.php"){
    ?>
    <!-- <div class="container text-muted text-start gx-0 p-1">
       Report List
    </div> -->
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Report List</li>
  </ol>
</nav>
    <?php
}

if($current_page=="addadoptionpet.php"){
    ?>
    <!-- <div class="container text-muted text-start gx-0 p-1">
        Add Pet for Adoption
    </div> -->
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Add Pet for Adoption</li>
  </ol>
</nav>
    <?php
}

if($current_page=="view-adoption-pet.php"){
    ?>
    <!-- <div class="container text-muted text-start gx-0 p-1">
       View Adoption Pet
    </div> -->
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">View Adoption Pet</li>
  </ol>
</nav>
    <?php
}

if($current_page=="update-adoption-pet.php"){
    ?>
    <!-- <div class="container text-muted text-start gx-0 p-1">
       Update Adoption Pet
    </div> -->
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Update Adoption Pet</li>
  </ol>
</nav>
    <?php
}


if($current_page=="addevent.php"){
    ?>
    <!-- <div class="container text-muted text-start gx-0 p-1">
       Add Event
    </div> -->
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Add Event</li>
  </ol>
</nav>
    <?php
}


if($current_page=="event-list.php"){
    ?>
    <!-- <div class="container text-muted text-start gx-0 p-1">
        Event List
    </div> -->
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Event List</li>
  </ol>
</nav>
    <?php
}


if($current_page=="adoption-pet-list-archive.php"){
    ?>
    
    <!-- <div class="container text-muted text-start gx-0 p-1">
        Adoption Pet Archive List
    </div> -->

    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Adoption Pet Archive List</li>
  </ol>
</nav>

    <?php
}

if($current_page=="pet-list-archive.php"){
    ?>
    
    <!-- <div class="container text-muted text-start gx-0 p-1">
         Pet Archive List
    </div> -->
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Pet Archive List</li>
  </ol>
</nav>
    <?php
}


if($current_page=="user-list-archive.php"){
    ?>
    
    <!-- <div class="container text-muted text-start gx-0 p-1">
         User Archive List
    </div> -->

    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">User Archive List</li>
  </ol>
</nav>

    <?php
}

if($current_page=="event-list-archive.php"){
    ?>
    
    <!-- <div class="container text-muted text-start gx-0 p-1">
         Event Archive List
    </div> -->

    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Event Archive List</li>
  </ol>
</nav>

    <?php
}



if($current_page=="report-list-archive.php"){
    ?>
    
    <!-- <div class="container text-muted text-start gx-0 p-1">
            Report Archive List
    </div> -->
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item gx-0 p-1"><a href="#" onclick="goBack()">Back</a></li>

    <li class="breadcrumb-item active gx-0 p-1" aria-current="page">Report Archive List</li>
  </ol>
</nav>
    <?php
}




?>


    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <?php
} else {
    // If HTTP_REFERER is not set or empty, display a simple back link
    ?>
    <!-- <a href="javascript:history.back()">Go Back</a> -->
    <?php
}
?>




