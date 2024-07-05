<?php 

session_start();

$return_arr["status"] = 0;
$return_arr["message"] = "No Action.";



//update admin user account
if(isset($_POST['id']) 
&& isset($_POST['address']) 
&& isset($_POST['fullname']) 
&& isset($_POST['address']) 
&& isset($_POST['is_email_verified']) 
&& isset($_POST['is_acount_verified']) ){
    include_once('dbconnect.php');

    // user i want to edit
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $is_email_verified = $_POST['is_email_verified'];
    $is_acount_verified = $_POST['is_acount_verified'];



    $stmt = $conn->prepare('UPDATE users 
    SET 
    fullname = :fullname,
    address = :address, 
    phone_number = :phone_number , 
    is_email_verified = :is_email_verified ,
    is_acount_verified = :is_acount_verified
    WHERE id = :id');


    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
    
    $stmt->bindParam(':is_email_verified', $is_email_verified, PDO::PARAM_INT);
    $stmt->bindParam(':is_acount_verified', $is_acount_verified, PDO::PARAM_INT);
     


    if ($stmt->execute()) {
        $return_arr["status"] = 1;
        $return_arr["message"] = "Update successful!";
    } 

}



//update own account
if(isset($_POST['fullname']) 
&& isset($_POST['address']) 
&& isset($_POST['phone_number']) ){
    include_once('dbconnect.php');

    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];


    $stmt = $conn->prepare('UPDATE users 
    SET 
    fullname = :fullname,
    address = :address, 
    phone_number = :phone_number
    WHERE id = :id');

    $id = $_SESSION['id'];
    $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        $return_arr["status"] = 1;
        $return_arr["message"] = "Update successful!";
    } 

}





//update own account
if(isset($_POST['fullname']) 
&& isset($_POST['address']) 
&& isset($_POST['phone_number']) ){
    include_once('dbconnect.php');

    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];

    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];


    $stmt = $conn->prepare('UPDATE users 
    SET 
    fullname = :fullname,
    address = :address, 
    phone_number = :phone_number
    WHERE id = :id');

    $id = $_SESSION['id'];
    $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':phone_number', $phone_number, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    if ($stmt->execute()) {
        $return_arr["status"] = 1;
        $return_arr["message"] = "Update successful!";
    } 

}









if(isset($_POST['password']) 
&& isset($_POST['password1']) ){
    include_once('dbconnect.php');

    $password = $_POST['password'];
    $password1 = $_POST['password1'];


    if($password != $password1){
        $return_arr["status"] = 2;
        $return_arr["message"] = "Password & Confirmed password not match.";
    }else{
       
        $email_from_session = $_SESSION['email'];
        // Prepare the SQL statement


        if(isset($_POST['id']) && $_SESSION['is_role']=='admin'){

            $id = $_POST['id'];

            $stmt = $conn->prepare('UPDATE users SET password = :password WHERE id = :id');
            // Bind parameters
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Using email from session

        }else{
            $stmt = $conn->prepare('UPDATE users SET password = :password WHERE email = :email');
    
            // Bind parameters
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email_from_session, PDO::PARAM_STR); // Using email from session
        }
        
    
        // Execute the statement
        $stmt->execute();
    
        // Check if the update was successful
        if ($stmt->rowCount() > 0) {
            $return_arr["status"] = 1;
            $return_arr["message"] = "Update successful!";
        } 
    
    }
    

    
}






echo json_encode($return_arr);

?>