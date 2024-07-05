<?php

session_start();
$uploadDir = '../uploads/adoption_pets/'. $_SESSION['email'] . '/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}


$originalFilename = pathinfo($_FILES['adoption_image']['name'], PATHINFO_FILENAME);
$fileExtension = pathinfo($_FILES['adoption_image']['name'], PATHINFO_EXTENSION);

$currentDateTime = date('YmdHis'); // Y - Year, m - Month, d - Day, H - Hours, i - Minutes, s - Seconds

$uploadFile = $uploadDir . $originalFilename . '_' . $currentDateTime . '.' . $fileExtension;


if (move_uploaded_file($_FILES['adoption_image']['tmp_name'], $uploadFile)) {
    //save to session
    $_SESSION['adoption_image'] = $uploadFile;

    $return_arr["status"] = 0;
    $return_arr["message"] = "na upload na";


} else {
    //echo 'Possible file upload attack!';
}
?>


