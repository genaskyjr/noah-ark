<?php
// Assuming you have a database connection established
// If not, you'll need to include your database connection code here

//archieve
if(isset($_POST['pet_id'])) {


    include_once('dbconnect.php');

    $pet_id = $_POST['pet_id'];

    //UPDATE `pets` SET `is_archive` = '1' WHERE `pets`.`pet_id` = 22; 
    $stmt = $conn->prepare('UPDATE `pets` SET `is_archive` = 1 WHERE `pet_id` = :pet_id');
    $stmt->bindParam(':pet_id', $pet_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
                // If deletion was successful
        echo json_encode(array('success' => true));

            } else {
                // If there was an error during deletion
                echo json_encode(array('success' => false));
            }
    
} else {
    // If 'pet_id' was not sent in the POST request
    echo json_encode(array('success' => false));
}



//unarchieve
if(isset($_POST['pet_id1'])) {


    include_once('dbconnect.php');

    $pet_id = $_POST['pet_id1'];

    //UPDATE `pets` SET `is_archive` = '1' WHERE `pets`.`pet_id` = 22; 
    $stmt = $conn->prepare('UPDATE `pets` SET `is_archive` = 0 WHERE `pet_id` = :pet_id');
    $stmt->bindParam(':pet_id', $pet_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
                // If deletion was successful
        echo json_encode(array('success' => true));

            } else {
                // If there was an error during deletion
                echo json_encode(array('success' => false));
            }
    
} else {
    // If 'pet_id' was not sent in the POST request
    echo json_encode(array('success' => false));
}
?>
