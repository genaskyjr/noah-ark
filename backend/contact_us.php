<?php

if(isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['message'])){
    include_once 'dbconnect.php';
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    date_default_timezone_set('Asia/Manila');
    $time = date('Y-m-d H:i:s');
    $sql = "INSERT INTO `messages` (`id`, `full_name`, `email`, `message`, `time`) VALUES (NULL, '$fullname', '$email', '$message', '$time') ";
    $conn->prepare($sql)->execute();
    $conn=null;
}else{

}


?>