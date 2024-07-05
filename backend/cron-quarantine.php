<?php 
include 'dbconnect.php';

$sql = "UPDATE `adoption_pets` SET `quarantine_day` = `quarantine_day` - 60";

// Execute the prepared statement
$stmt = $conn->prepare($sql);
$stmt->execute();


?>