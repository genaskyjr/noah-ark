<?php
session_start(); // Starting the session if not already started

// Assuming you've initialized $_SESSION['fullname'] elsewhere in your code


include 'dbconnect.php';

$return_arr = array(); // Initialize an array to store results



if(isset($_GET['status']) && $_GET['status'] == 'Adoptable'){
    $stmt = $conn->prepare("SELECT * FROM `adoption_pets` WHERE is_archive = 0 AND quarantine_day <= 0 ORDER BY `adoption_pets`.`quarantine_day` ASC");
}else if(isset($_GET['status']) && $_GET['status'] == 'Quarantine'){
    $stmt = $conn->prepare("SELECT * FROM `adoption_pets` WHERE is_archive = 0 AND quarantine_day > 0 ORDER BY `adoption_pets`.`quarantine_day` ASC");
}else{
    $stmt = $conn->prepare("SELECT * FROM `adoption_pets` WHERE is_archive = 0 ORDER BY `adoption_pets`.`quarantine_day` ASC");
}



$stmt->execute(); // Execute the statement first.

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if there are results
if ($result) {
    $return_arr['status'] = 'success';
    $return_arr['data'] = $result;
} else {
    $return_arr['status'] = 'error';
    $return_arr['message'] = 'No data found.';
}

// Return the data as JSON
header('Content-Type: application/json');
echo json_encode($return_arr);
?>
