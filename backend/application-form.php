<?php 
$response = array(
    'status' => 0,
    'message' => 'no action'
);

if (
    isset($_POST['reporter_fullname']) &&
    isset($_POST['reporter_email']) &&
    isset($_POST['reporter_address']) &&
    isset($_POST['adoption_number']) &&
    isset($_POST['reporter_phonenumber']) &&
    isset($_POST['reporter_notes']) &&
    isset($_POST['full_address']) &&
    isset($_POST['howmany']) &&
    isset($_FILES['file'])
) {
    session_start();
    include 'dbconnect.php';

    // Fetch user ID
    $user_id = $_SESSION['id'];

    // File details
    $user_id_picture = $_FILES['file']['name'];
    $temp_file = $_FILES['file']['tmp_name'];

    // Generate current date and time
    $date = date('Y-m-d H:i:s');

    $adoption_number = $_POST['adoption_number'];

    $howmany = $_POST['howmany'];
    $fulladdress = $_POST['full_address'];
    $reason = $_POST['reporter_notes'];

 

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO `adopt_application` (`adoption_number`, `date`, `user_id`, `user_id_picture`,`howmany`, `fulladdress`, `reason`) 
    VALUES (:adoption_number, :date, :user_id, :user_id_picture, :howmany, :fulladdress, :reason)");

    // Set the upload directory
    $uploadDir = '../uploads/application_id/';

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Final path of the uploaded file
    $uploadfullDir = $uploadDir . $user_id_picture;

    // Bind parameters
    $stmt->bindParam(':adoption_number', $adoption_number, PDO::PARAM_STR);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id_picture', $uploadfullDir, PDO::PARAM_STR);

    $stmt->bindParam(':howmany', $howmany, PDO::PARAM_INT);
    $stmt->bindParam(':fulladdress', $fulladdress, PDO::PARAM_STR);
    $stmt->bindParam(':reason', $reason, PDO::PARAM_STR);

    // Move uploaded file to the specified directory
    if (move_uploaded_file($temp_file, $uploadfullDir)) {
        // Execute the SQL statement
        if ($stmt->execute()) {
            $response = array(
                'status' => 1,
                'message' => 'RECEIVED'
            );
        } else {
            $response['message'] = 'Error in database operation';
        }
    } else {
        $response['message'] = 'Error in file upload';
    }
}

// Set the Content-Type header to indicate JSON response
header('Content-Type: application/json');

// Encode the response array to JSON and output it
echo json_encode($response);
?>
