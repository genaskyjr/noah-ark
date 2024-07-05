<?php 
    // Validate the input
    if(isset($_GET['path']) && !empty($_GET['path'])) {
        $uploadFile = $_GET['path'];

        // Define the Python script path
        $pythonScript = "/var/www/html/backend/classify_image.py";
        
        // Escape special characters in the parameter
        $parameter = escapeshellarg($uploadFile);

        // Construct the command to run the Python script
        $command = "python3 $pythonScript $parameter";

        // Execute the command and capture the output
        $result = shell_exec($command);

        // Check if the command executed successfully
        if($result === false) {
            $response = [
                'error' => 'Error executing Python script.'
            ];
        } else {
            // Remove newline characters from the result
            $result = trim($result);

            // Dummy value for $distance (replace this with your actual value)
            

            $response = [
                'uploadFile' => $uploadFile,
                'bestmatch' => $result
                
            ];
        }
    } else {
        $response = [
            'error' => 'Invalid or missing "path" parameter.'
        ];
    }

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
?>
