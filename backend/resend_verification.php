<?php 
include 'session.php';

if(isset($_GET['email']) && isset($_GET['fullnamemo'])){

    $email = $_GET['email'];
    $fullnamemo = $_GET['fullnamemo'];

    include 'dbconnect.php';

    require 'vendor/autoload.php';

    // Create a PHPMailer object
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $Exception = new PHPMailer\PHPMailer\Exception();
    
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'genaskypinlac0@gmail.com';   //email
    $mail->Password = 'suur xmhg gmiv aepk' ;   //16 character obtained from app password created
    $mail->Port = 465;  //SMTP port
    $mail->SMTPSecure = "ssl";

    //sender information
    $mail->setFrom('genaskypinlac0@gmail.com', 'Noah\'s Ark Dog & Cat Shelter');  // Fixed subject line here

    //receiver email address and name
    $mail->addAddress($email, $fullnamemo);  // Make sure to replace 'RECIPIENT_NAME' with actual name

    // get existing data
    $stmt = $conn->prepare("SELECT is_valid, verify_email_code, user_email FROM verify_email_codes WHERE user_email = :email");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Now you can access individual columns like this:
    $isvalid = $row['is_valid'];
    $verifyEmailCode = $row['verify_email_code'];
    $userEmail = $row['user_email'];


    if($isvalid=='1'){
        $uniqecode = $verifyEmailCode;
        //resent code
    }else{
        $uniqecode = uniqid();
        //make new code
        // update code into valid
   
    }



    $mail->isHTML(true);

    $mail->Subject = "Verification Link";  // Updated subject here
    $mail->Body = "<h4> Verification Link </h4>
                    <p> https://rvpn.site/verify.php?code=$uniqecode</p>";

    if (!$mail->send()) {
        $response = ['received_email' => $email, 'status' => 'error'];
        echo json_encode($response);
    } else {
        $response = ['received_email' => $email, 'status' => 'success'];
        echo json_encode($response);

                        // Update verification status
        $is_valid = 1;

        $stmt = $conn->prepare("UPDATE verify_email_codes SET is_valid = :is_valid, verify_email_code = :verify_email_code WHERE user_email = :user_email");
        $stmt->bindParam(':is_valid', $is_valid, PDO::PARAM_INT);
        $stmt->bindParam(':verify_email_code', $uniqecode, PDO::PARAM_STR);
        $stmt->bindParam(':user_email', $email, PDO::PARAM_STR);
                        
        $stmt->execute();


    }

    $mail->smtpClose();





}

?>



