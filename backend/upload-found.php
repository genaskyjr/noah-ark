<?php

session_start();
$uploadDir = '../uploads/reports/'. $_SESSION['email'] . '/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}


$originalFilename = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
$fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);


$currentDateTime = date('YmdHis'); // Y - Year, m - Month, d - Day, H - Hours, i - Minutes, s - Seconds

$uploadFile = $uploadDir . $originalFilename . '_' . $currentDateTime . '.' . $fileExtension;



if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
    //save to session
    $_SESSION['uploadedimageName'] = $uploadFile;

} else {
    //echo 'Possible file upload attack!';
}


?>


