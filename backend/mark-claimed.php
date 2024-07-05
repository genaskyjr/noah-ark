<?php
header('Content-Type: application/json');

// Archive
if (isset($_POST['report_id'])) {
    include('dbconnect.php');

    $report_id = $_POST['report_id'];
    date_default_timezone_set('Asia/Manila');

    $claimerName = $_POST['claimerName'];

    $stmt = $conn->prepare("UPDATE `astray_reports` SET `is_claim` = '1', `claimed_by` = :claimerName WHERE `report_id` = :report_id");

    $stmt->bindParam(':report_id', $report_id, PDO::PARAM_INT);
    $stmt->bindParam(':claimerName', $claimerName);

    $response = array();

    if ($stmt->execute()) {
        $response['status'] = 1;
        $response['message'] = 'Marked as claimed.';
    } else {
        $response['status'] = 0;
        $response['message'] = 'Error updating record.';
    }

    echo json_encode($response);
} elseif (isset($_POST['report_id1']) && isset($_POST['report_astray_image1'])) {
    // Your other block of code remains unchanged
    // Ensure to handle this block of code as per your requirements
    // ...
} else {
    $response['status'] = 0;
    $response['message'] = 'Invalid data received.';
    echo json_encode($response);
}
?>
