<?php 
include 'backend/session.php';


if(!isset($_SESSION['fullname'])){
    header("location:signin.php");
}


// Store the current page as the last visited page
$_SESSION['last_visited_page'] = $_SERVER['REQUEST_URI'];


?>


<div id="navbar" class="text-end container-fluid justify-content-between p-2 ">

   
<label id="labelko" for="toggle" class="btn left text-white fa-solid fa-bars pt-2 "></label>






<div class="left text-white">
        
   
        <a class="navbar-brand" href="/">
          <span id="navbar-title" class="text-white fs-4 p-3">Noah's Ark Dog & Cat Shelter</span>
        </a>
    </div>

    <div class="right text-white ">
        
        <div class="dropdown">
            <a class="btn dropdown-toggle text-white text-end" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <img id="logo" src="assets/logo.png" alt="Logo" width="25" height="25" class="d-inline-block align-text-top">
                <span  class="text-white fs-5"><?php echo $_SESSION['fullname'];?></span>
            </a>


            <ul id="menulist"class="dropdown-menu">
                <li><a class="dropdown-item text-black" href="/account.php">Edit Account</a></li>
                <li><a class="dropdown-item text-black" href="/logout.php">Logout</a></li>
            </ul>
        </div>


    </div>
  </div>


  <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js "></script>
