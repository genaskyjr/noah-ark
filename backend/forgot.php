<?php
if(isset($_POST['email'])) {
    include_once('dbconnect.php');

    $return_arr["status"] = 0;
    $return_arr["message"] = "No Action.";

    $email = $_POST['email'];

    $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
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
        $mail->addAddress($email, 'RECIPIENT_NAME');  // Make sure to replace 'RECIPIENT_NAME' with actual name

        $uniqecode = uniqid(TRUE);

        $mail->isHTML(true);

        $mail->Subject = "Reset Password Link";  // Updated subject here
        // $mail->Body = "<h4> Reset Password Link </h4>
        //                 <p> https://rvpn.site/reset.php?code=$uniqecode</p>";

        $mail->isHTML(true);
        // start email
        $mail->Body = '
        <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Card</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }

    .container {
      width: 80%;
      padding-right: 15px;
      padding-left: 15px;
      margin-right: auto;
      margin-left: auto;
    }

    .card {
      margin-top: 5%;
      max-width: 80%;
      background-color: #ffffff;
      border-radius: 10px;
      overflow: hidden;
    }

    .card-header {
      background-color: #dc3545;
      padding: 20px;
      text-align: center;
      color: #ffffff;
    }

    .logo {
      max-height: 100px;
      width: auto;
    }

    .card-header p {
      font-size: 24px;
      font-weight: bold;
      margin-top: 10px;
    }

    .card-body {
      padding: 20px;
    }

    .card-text {
      margin-bottom: 10px;
    }

    
  </style>
</head>
<body>

  <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center">
        <div class="container">
          <div class="card">
            <div class="card-header">
              <img src="https://i.imgur.com/pYTfDVN.png" alt="logo" class="img-fluid mr-2 logo">
              <p>"Some Angel choose furs instead of Wings"</p>
            </div>
            
            <div class="card-body">
              <p>Welcome! to Noahs Ark Dog And Cat Shelter.</p>
              <p>Hello, ' . $email . ', you are almost ready to complete the sign-up.</p>
              <p>Click here to Verify your Email:</p>
              <p><a href="https://rvpn.site/reset.php?code=' . $uniqecode . '">Verify Email</a></p>
            </div>
           
            
          </div>
        </div>
      </td>
    </tr>
  </table>

</body>
</html>


        ';
        

        // end email

        if (!$mail->send()) {
            echo 'Email not sent an error was encountered: ' . $mail->ErrorInfo;
        } else {
            

            //save to database
            $reset_code = $uniqecode; // Replace with your actual reset code
            $user_email = $email; // Replace with the actual user ID
            $is_valid = 1; // Assuming it starts as valid, adjust as needed

            $stmt = $conn->prepare("INSERT INTO reset_codes (reset_code, user_email, is_valid) VALUES (:reset_code, :user_email, :is_valid)");

            // Bind the parameters
            $stmt->bindParam(':reset_code', $reset_code, PDO::PARAM_STR);
            $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);
            $stmt->bindParam(':is_valid', $is_valid, PDO::PARAM_INT);
            
            // Execute the statement
            if ($stmt->execute()) {
                //echo "Record inserted successfully.";

                $return_arr["status"] = 1;
                $return_arr["message"] = "Sent code.";


            } else {
                //echo "Error inserting record: " . $stmt->errorInfo()[2];
            }


        }

        $mail->smtpClose();
    } else {
        $return_arr["status"] = 2;
        $return_arr["message"] = "Email Doesn't exist";
    }

    echo json_encode($return_arr);
    exit(0);
}
?>
