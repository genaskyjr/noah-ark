<?php

// Initialize response array
$response = array(
    'status' => 1,
    'message' => 'no action'
);



if (
    isset($_POST['adoption_number']) && 
    isset($_POST['adoption_gender']) && 
    isset($_POST['adoption_nickname']) && 
    isset($_POST['adoption_recued']) && 
    isset($_POST['adoption_type'])
) {
    $response = array(
        'status' => 1,
        'message' => 'received'
    );


             // Update database
             include_once('dbconnect.php');
             $adoption_number = $_POST['adoption_number'];
             $adoption_gender = $_POST['adoption_gender'];
             $adoption_recued = $_POST['adoption_recued'];
             $adoption_type = $_POST['adoption_type'];
             $adoption_nickname = $_POST['adoption_nickname'];


    if (!empty($_FILES['file']['name']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        // File was uploaded successfully
        $response = array(
            'status' => 1,
            'message' => 'have image'
        );

    session_start();
    $uploadDir = '../uploads/adoption_pets/' . $_SESSION['email'] . '/';
    
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $originalFilename = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
    $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    $currentDateTime = date('YmdHis');

    $uploadFile = $uploadDir . $originalFilename . '_' . $currentDateTime . '.' . $fileExtension;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
        //save to session

        $adoption_image = $uploadFile;

        $stmt = $conn->prepare("UPDATE adoption_pets SET adoption_gender=?, adoption_recued=?, adoption_type=?, adoption_image=?, adoption_nickname=? WHERE adoption_number = ?");
        
        if ($stmt->execute([$adoption_gender, $adoption_recued, $adoption_type, $adoption_image, $adoption_nickname, $adoption_number])) {
            if ($stmt->rowCount() > 0) {
                $response = array(
                    'status' => 1,
                    'message' => 'pdo successfully'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'No records updated'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'PDO execution error'
            );
        }
    } else {
        // $response = array(
        //     'status' => 0,
        //     'message' => 'Possible file upload attack!'
        // );
    }



    } else {
        // No image uploaded
        $response = array(
            'status' => 1,
            'message' => 'no image'
        );

 



     $stmt = $conn->prepare("UPDATE adoption_pets SET adoption_gender=?, adoption_recued=?, adoption_type=?,adoption_nickname=? WHERE adoption_number = ?");

     if ($stmt->execute([$adoption_gender, $adoption_recued, $adoption_type, $adoption_nickname, $adoption_number])) {
         if ($stmt->rowCount() > 0) {
             $response = array(
                 'status' => 1,
                 'message' => 'Record(s) updated successfully'
             );
         } else {
             $response = array(
                 'status' => 0,
                 'message' => 'No records updated'
             );
         }
     } else {
         $response = array(
             'status' => 0,
             'message' => 'PDO execution error'
         );
     }


    }


   


     
     




}else{
    $response = array(
        'status' => 1,
        'message' => 'fill out all forms except image'
    );
}


// Set the Content-Type header to indicate JSON response
header('Content-Type: application/json');

// Encode the response array to JSON and output it
echo json_encode($response);

?>
