<?php

// Start the session (assuming it hasn't been started elsewhere)
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the file was uploaded without errors
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/user_id/' . $_SESSION['email'] . '/';

        // Ensure the 'uploads' directory exists
        if (!is_dir($uploadDir)) {
            // Create the directory recursively with full permissions
            mkdir($uploadDir, 0777, true);
        }

        $originalFilename = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
        $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        $currentDateTime = date('YmdHis');
        $uploadFile = $uploadDir . $originalFilename . '_' . $currentDateTime . '.' . $fileExtension;

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {

            // Include the database connection file
            include_once('dbconnect.php');

            // Update the database with the file information
            $sql = "UPDATE `users` SET `identification_img` = :uploadFile WHERE `email` = :user_email";

            // Prepare the SQL statement
            $stmt = $conn->prepare($sql);

            // Bind the parameters
            $stmt->bindParam(':uploadFile', $uploadFile, PDO::PARAM_STR);
            $stmt->bindParam(':user_email', $_SESSION['email'], PDO::PARAM_STR);

            // Execute the statement
            if ($stmt->execute()) {
                // Send a success response back to the client
                echo json_encode(['success' => true, 'message' => 'File uploaded successfully']);
            } else {
                // Database update failed
                echo json_encode(['success' => false, 'message' => 'Error updating database']);
            }
        } else {
            // Failed to move the uploaded file
            echo json_encode(['success' => false, 'message' => 'Error moving file']);
        }
    } else {
        // File upload error
        echo json_encode(['success' => false, 'message' => 'File upload error']);
    }
} else {
    // Invalid request method
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
