<?php 
// For register
if(isset($_POST['fullname']) 
&& isset($_POST['email']) 
&& isset($_POST['password']) ){
    include_once('dbconnect.php');



    $return_arr["status"] = 0;
    $return_arr["message"] = "No Action.";

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
  

   
    $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        $return_arr["status"] = 1;
        $return_arr["message"] = "Email already registered.";
    } else {

        
        if($_POST['email']=='admin.noahsark@rvpn.site'){
            //for admin
            $sql = "INSERT INTO users (id, is_role, reg_date, fullname, email, password) 
            VALUES (1,'admin', NOW(), :fullname, :email, :password)";
        }else{
            //for user
            $sql = "INSERT INTO users (is_role, reg_date, fullname, email, password) 
            VALUES ('user', NOW(), :fullname, :email, :password)";
        }

            // Insert the user into the database
            // $sql = "INSERT INTO users (is_role, reg_date, fullname, email, password) 
            // VALUES ('user', NOW(), :fullname, :email, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            if ($stmt->execute() > 0) {
             $return_arr["status"] = 2;
             $return_arr["message"] = "Registered successfully, Redirect to Sign In Page.....";



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
            $mail->addAddress($email, $fullname);  // Make sure to replace 'RECIPIENT_NAME' with actual name
    
            $uniqecode = uniqid(TRUE);
    
            $mail->isHTML(true);
    
            $mail->Subject = "Verification Link";  // Updated subject here
            $mail->Body = "<h4> Verification Link </h4>
                            <p> https://rvpn.site/verify.php?code=$uniqecode</p>";
    
            if (!$mail->send()) {
                echo 'Email not sent an error was encountered: ' . $mail->ErrorInfo;
            } else {
                
    
                //save to database
                $reset_code = $uniqecode; // Replace with your actual reset code
                $user_email = $email; // Replace with the actual user ID
                $is_valid = 1; // Assuming it starts as valid, adjust as needed
    
                $stmt = $conn->prepare("INSERT INTO verify_email_codes (verify_email_code, user_email, is_valid) VALUES (:verify_email_code, :user_email, :is_valid)");
    
                // Bind the parameters
                $stmt->bindParam(':verify_email_code', $reset_code, PDO::PARAM_STR);
                $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);
                $stmt->bindParam(':is_valid', $is_valid, PDO::PARAM_INT);
                
                // Execute the statement
                if ($stmt->execute()) {
                    //echo "Record inserted successfully.";
    
                    $return_arr["status"] = 2;
                    $return_arr["message"] = "Registered successfully, Redirect to Sign In Page.....";
    
    
                } else {
                    //echo "Error inserting record: " . $stmt->errorInfo()[2];
                }
    
    
            }
    
            $mail->smtpClose();






            } else {
            $return_arr["status"] = 3;
            $return_arr["message"] = "Error registering user.";
            }
        
    } 
}
echo json_encode($return_arr);

?>