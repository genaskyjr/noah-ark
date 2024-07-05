<?php
// Assuming you have a database connection established
// If not, you'll need to include your database connection code here

//archive
if(isset($_POST['id'])) {
    $id = $_POST['id'];
	
	include_once('dbconnect.php');

    // // Perform the deletion query
    // $stmt = $conn->prepare('DELETE FROM users WHERE id = :id');
    // $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt = $conn->prepare('UPDATE users SET `is_archive` = 1 WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // If deletion was successful
        echo json_encode(array('success' => true));
    } else {
        // If there was an error during deletion
        echo json_encode(array('success' => false));
    }
} else {
    // If 'id' was not sent in the POST request
    echo json_encode(array('success' => false));
}

//unarchive
if(isset($_POST['id1'])) {
    $id = $_POST['id1'];
	
	include_once('dbconnect.php');

    // // Perform the deletion query
    // $stmt = $conn->prepare('DELETE FROM users WHERE id = :id');
    // $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt = $conn->prepare('UPDATE users SET `is_archive` = 0 WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // If deletion was successful
        echo json_encode(array('success' => true));
    } else {
        // If there was an error during deletion
        echo json_encode(array('success' => false));
    }
} else {
    // If 'id' was not sent in the POST request
    echo json_encode(array('success' => false));
}


?>
