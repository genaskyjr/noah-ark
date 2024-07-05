
<style>
  #archiev, #nav-link {
    text-decoration: none !important;
  }

  ul {
  list-style-type: none; /* Hide bullets */
  display: none;
}
</style>




  <div class="d-flex container-fluid gx-0">
        <!-- sidebar start -->
        <div>
        <input type="checkbox" id="toggle" >
        <label for="toggle"></label>


        <div id="sidebar" class="p-3" >
          

    
          <ul class="nav nav-pills mb-auto m">
            
          <?php 
          if($_SESSION['is_role']=="admin"){ ?>

            <li class="nav-item text-white" >
              <a href="/profile.php" id="profile" class="nav-link" aria-current="page">
              <i class="fa-solid fa-user"></i> My Profile 
              </a>
            </li>

            <li>
              <a href="/report-list.php" class="nav-link mt-1">
              <i class="fa-solid fa-message"></i> Stray Reports
              </a>
            </li> 

            <li>
              <a href="/addadoptionpet.php" class="nav-link mt-1">
              <i class="fa-solid fa-plus"></i> Add Pet for Adoption
              </a>
            </li>

            <li>
              <a href="/addpet.php" class="nav-link mt-1">
              <i class="fa-solid fa-plus"></i> Add Pet 
              </a>
            </li>

            <li>
              <a href="/mypets.php" class="nav-link mt-1">
              <i class="fa-solid fa-list"></i> My Pets
              </a>
            </li>
            <li>
              <a href="/adoption-pet-list.php" class="nav-link mt-1">
              <i class="fa-solid fa-list"></i> Adoption Pet List
              </a>
            </li>

            <li>
              <a href="/addevent.php" class="nav-link mt-1">
              <i class="fa-solid fa-plus"></i> Add Event
              </a>
            </li>
            <li>
              <a href="/event-list.php" class="nav-link mt-1">
              <i class="fa-solid fa-list"></i> Event List
              </a>
            </li>

            <li class="nav-item ">
              <a href="/user-list.php" class="nav-link" aria-current="page">
              <i class="fa-solid fa-list"></i> User List
              </a>
            </li>
            <li>
              <a href="/pet-list.php" class="nav-link mt-1">
              <i class="fa-solid fa-list"></i> Pet List
              </a>
            </li>

            <li>
              <a href="/application-list.php" class="nav-link mt-1">
              <i class="fa-solid fa-list"></i> Application List
              </a>
            </li>

                 

</style>

<li>
  <a href="#" id="archiev" class="nav-link toggleable text-white">
    <i class="fa-solid fa-box-archive"></i> Archive List
  </a>
  <ul style="display:none;" class="nav-pills mb-auto">
    <li><a href="/adoption-pet-list-archive.php" id="nav-link" class="nav-link text-white mt-1"><i class="fa-solid fa-list"></i> Adoption Pet List</a></li>
    <li><a href="/pet-list-archive.php" id="nav-link" class="nav-link text-white mt-1"><i class="fa-solid fa-list"></i> Pet List</a></li>
    <li><a href="/user-list-archive.php" id="nav-link" class="nav-link text-white mt-1"><i class="fa-solid fa-list"></i> User List</a></li>
    <li><a href="/event-list-archive.php" id="nav-link" class="nav-link text-white mt-1"><i class="fa-solid fa-list"></i> Event List</a></li>
    <li><a href="/report-list-archive.php" id="nav-link" class="nav-link text-white mt-1"><i class="fa-solid fa-list"></i> Report List</a></li>
    <li><a href="/claimed-pet-list.php" id="nav-link" class="nav-link text-white mt-1"><i class="fa-solid fa-list"></i> Claimed Pet List</a></li>

  </ul>
</li>





           

          <?php
          }else{


    
            if ($_SESSION['is_acount_verified'] == '0') {
                echo '<li class="nav-item">';
                echo '<a href="/profile.php" class="nav-link mt-1" aria-current="page">';
                echo '<i class="fa-solid fa-user"></i> My Profile';
                echo '</a>';
                echo '</li>';
                echo '<li class="nav-item">';
                echo '<a href="/account.php" class="nav-link mt-1" aria-current="page">';
                echo '<i class="fa-solid fa-user"></i> Verify my address';
                echo '</a>';
                echo '</li>';
            } else {
                echo '<li class="nav-item">';
                echo '<a href="/profile.php" class="nav-link mt-1" aria-current="page">';
                echo '<i class="fa-solid fa-user"></i> My Profile';
                echo '</a>';
                echo '</li>';
                echo '<li>';
                echo '<a href="/addpet.php" id="addpet" class="nav-link mt-1">';
                echo '<i class="fa-solid fa-plus"></i> Add Pet';
                echo '</a>';
                echo '</li>';
                echo '<li>';
                echo '<a href="/mypets.php" class="nav-link mt-1">';
                echo '<i class="fa-solid fa-paw"></i> My Pets';
                echo '</a>';
                echo '</li>';
                echo '<li>';
                echo '<a href="/found.php" class="nav-link mt-1">';
                echo '<i class="fa-solid fa-camera"></i> Report Stray';
                echo '</a>';
                echo '</li>';
                echo '<li>';
                echo '<a href="/adoption.php" class="nav-link mt-1">';
                echo '<i class="fa-solid fa-hands-holding"></i> Adoption';
                echo '</a>';
                echo '</li>';
            }
            ?>
          

            



          <?php }
          
          ?>

            


  

         

          </ul>  
        </div>
        </div>
        <!-- sidebar end -->

<script>
const navLinks = document.querySelectorAll('.nav-link');
var currentUrl = window.location.href;
navLinks.forEach(function(link) {
    if (currentUrl.includes(link.href)) {
        link.classList.add('active');
    }

    if (currentUrl.includes('#')) {

       document.getElementById('profile').classList.remove('active');



    }


});
</script> 


<script>
$(document).ready(function(){
  $('.nav-link.toggleable').click(function(){
    $(this).siblings('ul').toggle();
    


    navLinks.forEach(function(link) {
      link.classList.remove('active');
});

    document.getElementById('archiev').classList.add('active');

  });
});
</script>