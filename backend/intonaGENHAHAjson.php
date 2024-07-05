<?php 
include_once 'dbconnect.php';

try {


$petNames = array();

// Get pet names from GET parameters and store them in an array
for ($i = 1; $i <= 5; $i++) {
    if (isset($_GET['pet_name' . $i])) {
        $petNames[] = $_GET['pet_name' . $i];
    }
}

// Constructing the SQL query with multiple pet names using an IN clause
if (!empty($petNames)) {
    // Creating a comma-separated list of pet names
    $petNamesList = "'" . implode("','", $petNames) . "'";
    
    // SQL query with an IN clause to handle multiple pet names
    $sql = "SELECT p.pet_name, p.pet_type, p.pet_img, u.fullname AS pet_owner_fullname , u.email, u.phone_number, u.address
            FROM pets p 
            INNER JOIN users u ON p.pet_owner = u.id 
            WHERE p.pet_name IN ($petNamesList)";
    // Execute the query and fetch the results...
}
    
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
