<?php 
include_once 'dbconnect.php';

try {
    // SQL query to select `pet_img` and `pet_owner` from `pets` and `fullname` from `users`
    $sql = "SELECT p.pet_img,p.pet_name as petname, u.fullname
            FROM pets p
            INNER JOIN users u ON p.pet_owner = u.id
            WHERE p.is_archive = 0";
    
    // Prepare the SQL query
    $stmt = $conn->prepare($sql);
    
    // Execute the query
    $stmt->execute();
    
    // Fetch the results as an associative array
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Encode the results array into JSON format
    $jsonResponse = json_encode($results);
    
    // Set the response header to indicate JSON content
    header('Content-Type: application/json');
    
    // Output the JSON response
    echo $jsonResponse;
} catch(PDOException $e) {
    // Handle database connection or query errors
    echo "Connection failed: " . $e->getMessage();
}
?>
