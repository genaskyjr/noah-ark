<?php
// Assuming you have a database connection established
// If not, you'll need to include your database connection code here

//archive
if(isset($_POST['adoption_number'])) {
    $adoption_number = $_POST['adoption_number'];

    include_once('dbconnect.php');

    // Perform the deletion query
    $stmt = $conn->prepare('UPDATE adoption_pets SET `is_archive` = 1 WHERE adoption_number = :adoption_number');
    $stmt->bindParam(':adoption_number', $adoption_number, PDO::PARAM_INT);

    //
    if ($stmt->execute()) {
        // If deletion was successful
        echo json_encode(array('success' => true));
    } else {
        // If there was an error during deletion
        echo json_encode(array('success' => false));
    }
} else {
    // If 'adoption_number' was not sent in the POST request
    echo json_encode(array('success' => false));
}

//unarchive
if(isset($_POST['adoption_number1'])) {
    $adoption_number = $_POST['adoption_number1'];

    include_once('dbconnect.php');

    // Perform the deletion query
    $stmt = $conn->prepare('UPDATE adoption_pets SET `is_archive` = 0 WHERE adoption_number = :adoption_number');
    $stmt->bindParam(':adoption_number', $adoption_number, PDO::PARAM_INT);

    //
    if ($stmt->execute()) {
        // If deletion was successful
        echo json_encode(array('success' => true));
    } else {
        // If there was an error during deletion
        echo json_encode(array('success' => false));
    }
} else {
    // If 'adoption_number' was not sent in the POST request
    echo json_encode(array('success' => false));
}


?>
