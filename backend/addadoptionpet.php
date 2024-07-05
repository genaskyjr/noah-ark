<?php 
session_start();

// Initialize the response array
$return_arr["status"] = 0;
$return_arr["message"] = "No Action.";

// Check if all required fields are set
if (
    isset($_POST['adoption_gender']) &&
    isset($_POST['adoption_recued']) &&
    isset($_POST['adoption_type']) &&
    isset($_SESSION['adoption_image']) &&
    isset($_POST['adoption_nickname'])
) {

    include_once('dbconnect.php'); // Assuming dbconnect.php contains your database connection
    
    $sql = "INSERT INTO `adoption_pets` (
        `adoption_gender`, 
        `adoption_recued`, 
        `adoption_type`, 
        `adoption_image`,
        `adoption_nickname`     
    ) VALUES (
        :adoption_gender, 
        :adoption_recued, 
        :adoption_type, 
        :adoption_image,
        :adoption_nickname
    )";

    $stmt = $conn->prepare($sql);

    $adoption_gender = $_POST['adoption_gender'];
    $adoption_recued = $_POST['adoption_recued'];
    $adoption_type = $_POST['adoption_type'];
    $adoption_nickname = $_POST['adoption_nickname'];
    $adoption_image = $_SESSION['adoption_image'];



    $stmt->bindParam(':adoption_gender', $adoption_gender);
    $stmt->bindParam(':adoption_recued', $adoption_recued);
    $stmt->bindParam(':adoption_type', $adoption_type);
    $stmt->bindParam(':adoption_nickname', $adoption_nickname);
    $stmt->bindParam(':adoption_image', $adoption_image);


    if ($stmt->execute()) {
        $return_arr["status"] = 1;
        $return_arr["message"] = "Pet Adoption Added Successfully.";
		
		 //clear session
         $_SESSION['uploadedimageName'] = null;
    } 
}else{
    $return_arr["status"] = 2;
    $return_arr["message"] = "Fill out all forms";
}

echo json_encode($return_arr);
?>
