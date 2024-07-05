<?php 
if (
    isset($_GET['image']) &&
    isset($_GET['taken']) &&
    isset($_GET['type'])
) {
    $image = $_GET['image'];
    $taken = $_GET['taken'];
    $type = $_GET['type'];

    $pythonScript = "/var/www/html/backend/intonaGENHAHA.py";

    $escapedImage = escapeshellarg($image);
    $escapedTaken = escapeshellarg($taken);
    $escapedType = escapeshellarg($type);

    $command = "python3 " . escapeshellcmd($pythonScript) . " $escapedImage $escapedTaken $escapedType 2>&1";



    // Execute the command and capture the output
        $result = shell_exec($command);

            $data = $result;
            $start_index = strpos($data, "[{\"class_name\":");
            $end_index = strpos($data, "}") + 1;
            
            $extracted_data = substr($data, $start_index, $end_index);
            
            $decoded_data = json_decode($extracted_data, true);
        

      
        
    
    
    
    header('Content-Type: application/json');
    echo json_encode($decoded_data);

}
?>