

<?php


session_start();
include_once('dbconnect.php');



    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
    }

    //set user session from email
    $STH = $conn->prepare('SELECT `id`, `is_role`, `reg_date`, `fullname`, `email`, `address`, `phone_number`, `password`, `is_email_verified`, `is_acount_verified`, identification_img, `session` FROM `users` WHERE email = :email');
    $STH->bindParam(':email', $email, PDO::PARAM_STR);
    $STH->execute();   
    
    // Setting the fetch mode
    $STH->setFetchMode(PDO::FETCH_ASSOC);
    
    while($row = $STH->fetch()) {
        //set session
        $_SESSION['id'] = $row['id'];
        $_SESSION['is_role'] =  $row['is_role'];
        $_SESSION['reg_date'] =  $row['reg_date'];
        $_SESSION['fullname'] =  $row['fullname'];
        $_SESSION['email'] =  $row['email'];
        $_SESSION['address'] =  $row['address'] ;
        $_SESSION['password'] =  $row['password'] ;
        $_SESSION['phone_number'] =  $row['phone_number'];

        $_SESSION['is_email_verified'] =  $row['is_email_verified'] ;
        $_SESSION['is_acount_verified'] =  $row['is_acount_verified'];


  
        $_SESSION['identification_img'] =  $row['identification_img'];


        // uncomment to activate 1login at a time

        // if (isset($_SESSION['session']) && $_SESSION['session'] != $row['session']) {
        //     // Output the JavaScript code that uses Swal for the alert
        //     echo "<script>
        //             Swal.fire({
        //                 title: 'Login in other device',
        //                 text: 'We detected you logged in to another device. You will be automatically logged out.',
        //                 icon: 'info',
        //                 confirmButtonText: 'Ok'
        //             }).then((result) => {
        //                 if (result.isConfirmed) {
        //                     window.location.href = 'logout.php';
        //                 }
        //             });
        //           </script>";
        //     exit; // Terminate further execution
        // }


     

        
    }





?>

