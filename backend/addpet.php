<?php 



session_start();

// Initialize the response array
$return_arr["status"] = 0;
$return_arr["message"] = "No Action.";

$dateChange = date('Y-m-d H:i:s'); // Use date() function to get the current timestamp

// Check if all required fields are set
if (
    isset($_POST['pet_name']) &&
    isset($_POST['pet_gender']) &&
    isset($_POST['pet_birthday']) &&
    isset($_POST['pet_type']) &&
    isset($_SESSION['fullname']) &&
    isset($_SESSION['uploadedimageName'])
) {

    include_once('dbconnect.php'); // Assuming dbconnect.php contains your database connection
    
    $sql = "INSERT INTO `pets` (
        `pet_id`, 
        `pet_reg_date`, 
        `pet_name`, 
        `pet_gender`, 
        `pet_birthday`, 
        `pet_type`, 
        `pet_img`, 
        `pet_owner`, 
        `pet_last_vaccine`, 
        `pet_next_vaccine`
    ) VALUES (
        null,
        '$dateChange', 
        :pet_name, 
        :pet_gender, 
        :pet_birthday, 
        :pet_type, 
        :pet_img, 
        :pet_owner, 
        :pet_last_vaccine, 
        :pet_next_vaccine
    )";

    $stmt = $conn->prepare($sql);

    $petname = $_POST['pet_name'];
    $pet_gender = $_POST['pet_gender'];
    $pet_birthday = $_POST['pet_birthday'];
    $pet_type = $_POST['pet_type'];
    $pet_img = $_SESSION['uploadedimageName'];
    $pet_owner = $_SESSION['id'];
    $pet_last_vaccine = $_POST['pet_last_vaccine']; // Corrected variable name
    $pet_next_vaccine = $_POST['pet_next_vaccine']; // Corrected variable name

    $stmt->bindParam(':pet_name', $petname);
    $stmt->bindParam(':pet_gender', $pet_gender);
    $stmt->bindParam(':pet_birthday', $pet_birthday);
    $stmt->bindParam(':pet_type', $pet_type);
    $stmt->bindParam(':pet_img', $pet_img);
    $stmt->bindParam(':pet_owner', $pet_owner);
    $stmt->bindParam(':pet_last_vaccine', $pet_last_vaccine); // Corrected variable name
    $stmt->bindParam(':pet_next_vaccine', $pet_next_vaccine); // Corrected variable name




    if ($stmt->execute()) {

       
try {
    

    $oldOwner = $_SESSION['id'];
    $newOwner = $_SESSION['id'];
    

    // Get the auto-generated ID
    $lastInsertedId = $conn->lastInsertId();

    // Your SQL query
    $sql = "INSERT INTO `change_owner` (`pet_id`,`old_owner`, `new_owner`, `date_change`) VALUES (:pet_id, :old_owner, :new_owner, :date_change)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':pet_id', $lastInsertedId);
    $stmt->bindParam(':old_owner', $oldOwner);
    $stmt->bindParam(':new_owner', $newOwner);
    $stmt->bindParam(':date_change', $dateChange);

    // Execute the statement
    $stmt->execute();

    // $return_arr["status"] = 1;
    // $return_arr["message"] = $result;
    
    // $return_arr["status"] = 1;
    // $return_arr["message"] = "aded pet successfuly";

    //cut and save
    $uploadFile = $pet_img;

    // Define the Python script path
    $pythonScript = "/var/www/html/backend/addpet/cut.py";
    
    // Escape special characters in the parameter
    $parameter = escapeshellarg($uploadFile);

    // Construct the command to run the Python script
    $command = "python3 $pythonScript $parameter";

    // Execute the command and capture the output
    //$result = shell_exec($command);
    $result = trim(shell_exec($command));



    
    // $return_arr["status"] = 1;
    // $return_arr["message"] = $result;

   
    try {
        //$pet_img = '/path/to/your/pet/image.jpg'; // Replace with the actual path to your pet image
        //$result = '/path/to/your/result/image.jpg'; // Replace with the actual path to your result image
    
        if (file_exists($pet_img)) {
            // Remove the old pet image
            unlink($pet_img);
    
            // Copy the new image to the pet image location
            if (copy($result, $pet_img)) {
                $return_arr["status"] = 1;
                $return_arr["message"] = 'File replaced successfully.';
                
                

            } else {
                $return_arr["status"] = 1;
                $return_arr["message"] = 'Error copying the new file.';
            }
        } else {
            $return_arr["status"] = 1;
            $return_arr["message"] = 'The pet image does not exist.';
        }
    } catch (Exception $e) {
                $return_arr["status"] = 1;
                $return_arr["message"] = 'An error occurred: ' . $e->getMessage();
    }






} catch (PDOException $e) {
    $return_arr["status"] = 0;
    $return_arr["message"] = $e->getMessage();
}








        // $return_arr["status"] = 1;
        // $return_arr["message"] = "Pet Added Successfully.";

         //clear session
         $_SESSION['uploadedimageName'] = null;
         
    } 
}else{
    $return_arr["status"] = 2;
    $return_arr["message"] = "Fill out all forms";
}


// do clean up
$directoryPath = '/var/www/html/backend/addpet/cropped_images';

// Check if the directory exists
if (is_dir($directoryPath)) {
    // Use exec to run the rm command
    $command = "rm -rf $directoryPath";
    
    // Execute the command
    exec($command, $output, $exitCode);

    // Check the exit code to determine if the command was successful
    if ($exitCode === 0) {
        //echo 'Directory and its contents removed successfully.';
        $return_arr["status"] = 1;
        $return_arr["message"] = 'Directory and its contents removed successfully.';
    } else {
        //echo 'Error removing directory: ' . implode("\n", $output);
    }
} else {
    //echo 'The directory does not exist.';
}


echo json_encode($return_arr);






?>
