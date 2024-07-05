<?php
$servername = "66.42.49.11";
$username = "newuser";
$password = 'pa$$word';

try {
  $conn = new PDO("mysql:host=$servername;dbname=noah", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
} catch(PDOException $e) {
 // echo "Connection failed: " . $e->getMessage();

}



?> 
