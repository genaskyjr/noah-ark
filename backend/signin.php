<?php 

session_start();
//for login
if(isset($_POST['email']) && isset($_POST['password'])){
    
    include_once('dbconnect.php');
    $return_arr["status"] = 0;
    $return_arr["message"] = "No Action.";

    
    $email = $_POST['email'];
    $password = $_POST['password'];



    // Assuming you've sanitized your inputs to prevent SQL injection
    $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email AND password = :password');
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {

        //check if email is verifiyed

            //get if verified or not 
            // 1 for verified
            // 0 for not
            $stmt = $conn->prepare("SELECT is_email_verified FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $isverified = $stmt->fetch(PDO::FETCH_COLUMN);


            $stmt = $conn->prepare("SELECT fullname FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $fullnamemo = $stmt->fetch(PDO::FETCH_COLUMN);


            if($isverified=='0'){
                $return_arr["status"] = 4;
                $return_arr["message"]= $isverified; //redirect to index.php
                $return_arr["email"] = $email;
                $return_arr["fullnamemo"] = $fullnamemo;
                echo json_encode($return_arr);
                exit;

            }

        // set session
        
        $_SESSION['email'] = $email;
       
        $return_arr["status"] = 1;
        $return_arr["message"]=" Login Successful, Please wait..."; //redirect to index.php


        //set session

        // Function to generate a random token
        function generateRandomToken($length = 6) {
            return bin2hex(random_bytes($length));
        }

        // Generate a random token
        $token = generateRandomToken();


        $sql = "UPDATE `users` SET `session` = :session WHERE `email` = :email";
        $stmt = $conn->prepare($sql);
        
        // Bind parameters and execute the statement
        $stmt->bindParam(':session', $token, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $_SESSION['session'] = $token;

    

    } else {
        $return_arr["status"] = 2;
        $return_arr["message"] = "Wrong email or password.";
       
    }





   
       
}
echo json_encode($return_arr);
   

?>