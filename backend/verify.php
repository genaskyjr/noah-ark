<?php

$response = array(
    'status' => 0,
    'message' => "No Action."
);

// Check if all required POST parameters are set
if (isset($_POST['code']) && isset($_POST['phone_number']) && isset($_POST['address'])) {

    // Sanitize user inputs
    $code = $_POST['code'];
    $number = $_POST['phone_number'];
    $address = $_POST['address'];

    include_once('dbconnect.php');

    // Check verification code
    $stmt = $conn->prepare("SELECT user_email, verify_email_code, is_valid FROM verify_email_codes WHERE verify_email_code = :verify_email_code");
    $stmt->bindParam(':verify_email_code', $code, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result && $result['is_valid'] == '1') {
        // Change 1 if running
        $user_email = $result['user_email'];

        // Update verification status
        $stmt = $conn->prepare("UPDATE verify_email_codes SET is_valid = :is_valid WHERE user_email = :user_email");
        $is_valid = 0;
        $stmt->bindParam(':is_valid', $is_valid, PDO::PARAM_INT);
        $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);

       

        if ($stmt->execute()) {

          

            $response = array(
                'status' => 1,
                'message' => "Verification status updated successfully."
            );

            

            // Save image directory and save id
            $uploadDir = '../uploads/user_id/' . $user_email . '/';

            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Check if the file is uploaded successfully
            if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
                $originalFilename = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

                $currentDateTime = date('YmdHis');
                $uploadFile = $uploadDir . $originalFilename . '_' . $currentDateTime . '.' . $fileExtension;

                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
                    // File uploaded successfully
               

                    $response = array(
                        'status' => 1,
                        'message' => "File uploaded successfully"
                    );



                        // Save is_email_verified as 1
                $sql = "UPDATE `users` SET `is_email_verified` = '1' ,`identification_img` = '$uploadFile' WHERE `users`.`email` = :user_email";

                // Prepare the SQL statement
                $stmt = $conn->prepare($sql);

                // Bind the parameter
                $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);

                // Execute the statement
                $stmt->execute();




                    // Optionally, you may save the file path to the session or database
                    $_SESSION['uploaded_file'] = $uploadFile;
                } else {
                 
                    $response = array(
                        'status' => 1,
                        'message' => "Error moving uploaded file."
                    );
                }
            } else {
                
                $response = array(
                    'status' => 1,
                    'message' => 'File upload error: ' . $_FILES['file']['error']
                );

            }
        } else {
           

            $response = array(
                'status' => 1,
                'message' => 'Error updating verification status.'
            );

        }
    } else {
     
        $response = array(
            'status' => 2,
            'message' => 'Link Already Expired or Invalid verify code.'
        );


    }
} else {
    $response["message"] = "Fill all forms.";
    
    $response = array(
        'status' => 0,
        'message' => "No Action."
    );
    
}

// Set the Content-Type header to indicate JSON response
header('Content-Type: application/json');

// Encode the response array to JSON and output it
echo json_encode($response);

?>
