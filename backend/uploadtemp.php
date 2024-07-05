<?php

session_start();
$uploadDir = '../uploads/temp/' . $_SESSION['email'] . '/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$originalFilename = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
$fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

$currentDateTime = date('YmdHis'); // Y - Year, m - Month, d - Day, H - Hours, i - Minutes, s - Seconds

$uploadFile = $uploadDir . $originalFilename . '_' . $currentDateTime . '.' . $fileExtension;

if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
    $_SESSION['uploadedimageName'] = $uploadFile;
	
    //echo json_encode($uploadFile);

	$pythonScript = "/var/www/html/backend/img.py";
	$parameter = escapeshellarg($uploadFile);
	$command = "python3 $pythonScript $parameter";
	
	$result = shell_exec($command);

        // Check if the command executed successfully
        if($result === false) {
            $response = [
                'error' => 'Error executing Python script.'
            ];
        } else {
            // Remove newline characters from the result
            $result = trim($result);

            $response = [
                'uploadFile' => $uploadFile,
                'result' => $result
            ];
        }
		
	echo json_encode($response);	
	
	
	
} else {
    //echo 'Possible file upload attack!';
}
