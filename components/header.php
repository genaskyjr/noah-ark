

<!-- nav-->
<nav class="navbar navbar-expand-lg bg-light">


  <div id="nav" class="container-fluid d-flex bg-light">
        
  <style>
          .truncated-text {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
</style>
    
        <a class="navbar-brand" href="/">
          <div class="container-fluid gx-0">
            <img class="img-fluid rounded-circle bg-light" src="assets/logo.png" alt="Logo" width="60" height="60">
            <span id="title" class="align-end truncated-text">Noah's Ark Dog & Cat Shelter</span>
          </div>
          
        </a>
       

        <button id="button"class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse justify-content-end ml-3 mr-3" id="navbarNav">

      <ul class="navbar-nav" id="ulnav">
          

          <?php 
          if(!isset($_SESSION['email'])){?>
              <li class="nav-item">
              <a class="nav-link" href="#home">Home</a>
          </li>
          <?php
          }else{?>
              <li class="nav-item">
              <a class="nav-link" href="/profile.php">Profile</a>
          </li>
          <?php
          }
          
          ?>
          <li class="nav-item">
            <a class="nav-link" href="#event">Events</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#faq">FAQ</a>
          </li>         
          <li class="nav-item">
            <a class="nav-link" href="#donation">Donation</a>
          </li>
          <?php 
          if(!isset($_SESSION['email'])){?>
              <li class="nav-item">
              <a class="nav-link" href="/signin.php">Sign In</a>
          </li>
          <?php
          }else{?>
              <li class="nav-item">
              <a class="nav-link" href="/logout.php">Logout</a>
          </li>
          <?php
          }?>
        </ul>
    </div>
  </div>
</nav>
<!-- nav-->


<style>
  /* Add these styles to make nav-link items look clickable */
/* Add these styles to make the navigation bar visually appealing */
.navbar {
    background-color: #ffffff; /* Change to your desired background color */
}

.navbar-brand img {
    margin-right: 10px; /* Adjust the spacing between the logo and title */
}

.navbar-brand #title {
    font-weight: bold; /* Make the title bold */
    font-size: 20px;
}

.navbar-nav .nav-link {
    color: #333333; /* Change to your desired text color */
    font-size: 20px;

}

/* .navbar-nav .nav-link:hover {
    background-color: #198754;
    color: #fff;
    font-size: 21px;
    border-radius: 0.5rem;
} */
</style>

<script>
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
</script>
