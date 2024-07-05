<?php

// Initialize response array
$response = array(
    'status' => 0,
    'message' => 'no action'
);

if (
    isset($_POST['reporter_fullname']) &&
    isset($_POST['reporter_email']) &&
    isset($_POST['reporter_address']) &&
    isset($_POST['reporter_phonenumber']) &&
    isset($_POST['reporter_notes']) &&
    isset($_POST['barangay_taken']) &&
    isset($_FILES['file']) &&
    isset($_POST['location_link'])
) {

    
    $uploadDir = '../uploads/reports/' . $_POST['reporter_email'] . '/';

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $originalFilename = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
        $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

        $currentDateTime = date('YmdHis');
        $uploadFile = $uploadDir . $originalFilename . '_' . $currentDateTime . '.' . $fileExtension;


        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
     
            
            $pythonScript = "/var/www/html/backend/found.py";
            $parameter = escapeshellarg($uploadFile);
            $command = "python3 $pythonScript $parameter";
            $result = trim(shell_exec($command));
            $type = null;
            if (strpos($result, '/var/www/html/backend/cropped_images/crops/dog') !== false) {
                $type = 'Dog';
                $response = array(
                    'status' => 1,
                    'message' => 'Dog'
                );
            }else if(strpos($result, '/var/www/html/backend/cropped_images/crops/cat') !== false) {
                $type = 'Cat';
                $response = array(
                    'status' => 1,
                    'message' => 'Cat'
                );
            }else{
                $type = null;
                $response = array(
                    'status' => 2,
                    'message' => 'no dog or cat detected'
                );

            }



            if (copy($result, $uploadFile)) {
                $response = array(
                    'status' => 1,
                    'message' => 'replace orig to new cropted'
                );
            }}}

            //save to database

include_once('dbconnect.php');
$sql = "INSERT INTO `astray_reports` (
    `report_daytime`, 
    `report_astray_image`, 
    `report_astray_location`, 
    `reporter_notes`, 
    `reporter_name`, 
    `reporter_email`, 
    `reporter_number`,
    `barangay_taken`,
    `type`
) VALUES (
    :report_daytime, 
    :report_astray_image, 
    :report_astray_location, 
    :reporter_notes, 
    :reporter_fullname, 
    :reporter_email, 
    :reporter_number,
    :barangay_taken,
    :type
)";

$stmt = $conn->prepare($sql);


$reporter_fullname = $_POST['reporter_fullname'];
$reporter_email = $_POST['reporter_email'];
$reporter_address = $_POST['reporter_address'];
$reporter_phonenumber = $_POST['reporter_phonenumber'];
$location_link = $_POST['location_link'];
$reporter_notes = $_POST['reporter_notes'];

$barangay_taken = $_POST['barangay_taken'];

$report_daytime = date("Y-m-d H:i:s");



$stmt->bindParam(':report_daytime', $report_daytime, PDO::PARAM_STR);
$stmt->bindParam(':report_astray_image', $uploadFile, PDO::PARAM_STR);
$stmt->bindParam(':report_astray_location', $location_link, PDO::PARAM_STR);
$stmt->bindParam(':reporter_notes', $reporter_notes, PDO::PARAM_STR);
$stmt->bindParam(':reporter_fullname', $reporter_fullname, PDO::PARAM_STR);
$stmt->bindParam(':reporter_email', $reporter_email, PDO::PARAM_STR);
$stmt->bindParam(':reporter_number', $reporter_phonenumber, PDO::PARAM_STR);
$stmt->bindParam(':barangay_taken', $barangay_taken, PDO::PARAM_STR);
$stmt->bindParam(':type', $type, PDO::PARAM_STR);

        if ($stmt->execute()) {
         			
			$response = array(
                'status' => 1,
                'message' => 'inserted'
            );}

   


}



$directoryPath = '/var/www/html/backend/cropped_images';
if (is_dir($directoryPath)) {
    // Use exec to run the rm command
    $command = "rm -rf $directoryPath";
    
    // Execute the command
    exec($command, $output, $exitCode);

    // Check the exit code to determine if the command was successful
    if ($exitCode === 0) {
        //echo 'Directory and its contents removed successfully.';
    
    } else {
        //echo 'Error removing directory: ' . implode("\n", $output);
    }
}



// Set the Content-Type header to indicate JSON response
header('Content-Type: application/json');

// Encode the response array to JSON and output it
echo json_encode($response);