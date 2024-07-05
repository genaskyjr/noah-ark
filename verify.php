<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="assets/logo.png">

    <title>Verify Email</title>

    <!--bootstrap 5.2.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!--homepage css -->
    <link rel="stylesheet" href="css/signin.css">
    
    <!--jquery cdn -->
    <script
    src="https://code.jquery.com/jquery-3.7.1.js"
    integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
    
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css " rel="stylesheet">

    <script src="js/resetValidation.js"></script>


  </head>
  <body>
<script src="js/zoom.js"></script>
    <section>
        <div class="container mt-4 pt-4">
          <div class="row">
            <div class="col-12 col-sm-7 col-md-6 m-auto">
              <div class="card border-0 shadow mb-4">
                <div class="card-body">
                    <img src="/assets/logo.png" class="rounded mx-auto d-block w-25" alt="...">
                    <h1 class="text-center" id="one">Verification</h1>
                    <p class="text-center" id="two">Fill out additional infomation thank you!</p>



 <form id="verify_email_form" enctype="multipart/form-data" method="post">
    <label for="code" class="d-none">Code</label>
    <input class="d-none" readonly value="<?php 
    echo $_GET['code'];

    ?>" autocomplete="off" type="text" name="code" id="code" class="form-control my-1 mb-3 py-2" placeholder="" required/>


    <label for="address">Barangay<span class="text-danger">*<span></label>
    <select id="address" name="address" class="form-control my-1 mb-3 py-2" required>
    <option value="" disabled selected>Select address</option>
    <option value="Atlu-Bola">Atlu-Bola</option>
    <option value="Bical">Bical</option>
    <option value="Bundagul">Bundagul</option>
    <option value="Cacutud">Cacutud</option>
    <option value="Calumpang">Calumpang</option>
    <option value="Camachiles">Camachiles</option>
    <option value="Dapdap">Dapdap</option>
    <option value="Dau">Dau</option>
    <option value="Dolores">Dolores</option>
    <option value="Duquit">Duquit</option>
    <option value="Lakandula">Lakandula</option>
    <option value="Mabiga">Mabiga</option>
    <option value="Macapagal Village">Macapagal Village</option>
    <option value="Mamatitang">Mamatitang</option>
    <option value="Mangalit">Mangalit</option>
    <option value="Marcos Village">Marcos Village</option>
    <option value="Mawaque (Mauaque)">Mawaque (Mauaque)</option>
    <option value="Paralayunan">Paralayunan</option>
    <option value="Poblacion">Poblacion</option>
    <option value="San Francisco">San Francisco</option>
    <option value="San Joaquin">San Joaquin</option>
    <option value="Santa Ines">Santa Ines</option>
    <option value="Santa Maria">Santa Maria</option>
    <option value="Santo Rosario">Santo Rosario</option>
    <option value="Sapang Balen">Sapang Balen</option>
    <option value="Sapang Biabas">Sapang Biabas</option>
    <option value="Tabun">Tabun</option>
</select>


    <label for="phone_number">Phone Number<span class="text-danger">*<span></label>
    <input type="text" name="phone_number" id="phone_number" class="form-control my-1 mb-3 py-2" placeholder="(11 digits) ex. 09xxxxxxxxx" required pattern="[0-9]{11}"/>


    <label for="file">Proof of Residency<span class="text-mute"> (ex: National ID)<span><span class="text-danger">*<span></label>
    <input name="file" type="file" class="form-control mb-3 py-2 my-1" id="file" accept="image/*" aria-describedby="inputGroupFileAddon04" aria-label="Upload" required>
   

   <img id="blah" src="#" alt="Preview" width="150" class="my-1 mb-3 py-2" height="150" style="display:none;">


    <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary" id="submitmona">Verify</button>
    </div>

    <a href="/signin.php" class="nav-link text-start text-primary mt-3">Already have an account?</a>
    
</form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      

      

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


<script>
$(document).ready(function() {

    $('#verify_email_form').on('submit', function(e) {
      document.getElementById("submitmona").disabled = true;
        e.preventDefault();

        

        var formData = new FormData(this);

        console.log(formData);



        $.ajax({
            url: 'backend/verify.php', // Replace with the URL to your upload script
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response.message);

                if (response.status === 1) {
                    Swal.fire({
                        title: 'Successfully Verified!',
                        text: 'Welcome to Noah’s Ark Official Website.',
                        icon: 'success',
                        confirmButtonText: 'Confirm'
                    }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = 'signin.php';
                        }
                    });

                    document.getElementById("submitmona").disabled = false;

                } else if(response.status === 2){

                  Swal.fire({
                        title: 'Expired Link',
                        text: 'Link Already Expired or Invalid verify code.',
                        icon: 'info',
                        confirmButtonText: 'Confirm'
                    }).then((result) => {
                        if (result.isConfirmed) {
                          window.location.href = 'index.php';
                        }
                    });
                    document.getElementById("submitmona").disabled = false;

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

                    document.getElementById("submitmona").disabled = false;

                    
                }
            },
            error: function(error) {
                console.log(error.statusText);
            }
        });
    });
});
</script>

  

    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js "></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>



  </body>
</html>
