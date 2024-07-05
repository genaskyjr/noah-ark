<?php
header('Content-Type: application/json');

//archive
if(isset($_POST['report_id']) && isset($_POST['report_astray_image'])) {
    include('dbconnect.php');

    date_default_timezone_set('Asia/Manila');

    $adoption_image = $_POST['report_astray_image']; 
    $quarantine_day = 1296000;

    $stmt = $conn->prepare("INSERT INTO `adoption_pets` 
        (`adoption_image`, `quarantine_day`, `adoption_recued`) 
        VALUES 
        (:adoption_image, :quarantine_day, CURDATE())");

    $stmt->bindParam(':adoption_image', $adoption_image);
    $stmt->bindParam(':quarantine_day', $quarantine_day);

    if ($stmt->execute()) {

        $report_id = $_POST['report_id']; // Assuming you want to update report_id 100

        $stmt = $conn->prepare("UPDATE astray_reports SET is_archive = '1' WHERE report_id = :report_id");

        $stmt->bindParam(':report_id', $report_id, PDO::PARAM_INT);

        $stmt->execute();


        $response['status'] = 1;
        $response['message'] = 'Pet Adoption Added Successfully.';

        

    } else {
        $response['status'] = 0;
        $response['message'] = 'Error inserting record.';
    }

    echo json_encode($response);
}else if(isset($_POST['report_id1']) && isset($_POST['report_astray_image1'])){
    include('dbconnect.php');

    date_default_timezone_set('Asia/Manila');

    $adoption_image = $_POST['report_astray_image1']; 
    $quarantine_day = 1296000;

    $stmt = $conn->prepare("INSERT INTO `adoption_pets` 
        (`adoption_image`, `quarantine_day`, `adoption_recued`) 
        VALUES 
        (:adoption_image, :quarantine_day, CURDATE())");

    $stmt->bindParam(':adoption_image', $adoption_image);
    $stmt->bindParam(':quarantine_day', $quarantine_day);

    if ($stmt->execute()) {

        $report_id = $_POST['report_id1']; // Assuming you want to update report_id 100

        $stmt = $conn->prepare("UPDATE astray_reports SET is_archive = '0' WHERE report_id = :report_id");

        $stmt->bindParam(':report_id', $report_id, PDO::PARAM_INT);

        $stmt->execute();


        $response['status'] = 1;
        $response['message'] = 'Pet Adoption Added Successfully.';

        

    } else {
        $response['status'] = 0;
        $response['message'] = 'Error inserting record.';
    }

    echo json_encode($response);

} else {
    $response['status'] = 0;
    $response['message'] = 'Invalid data received.';
    echo json_encode($response);
}




?>
