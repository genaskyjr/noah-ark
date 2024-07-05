<?php
session_start();

// Check if the file and session data are set
if (isset($_FILES['file']) && isset($_SESSION['email'])) {
    // Your previous code for handling file uploads...
    
    $return_arr = array(); // Initialize the response array


    $uploadDir = '../uploads/pets/'. $_SESSION['email'] . '/';

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }


    $originalFilename = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
    $fileExtension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    $currentDateTime = date('YmdHis'); // Y - Year, m - Month, d - Day, H - Hours, i - Minutes, s - Seconds

    $uploadFile = $uploadDir . $originalFilename . '_' . $currentDateTime . '.' . $fileExtension;

    $uploadFilesave = $uploadFile;

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
        // File uploaded successfully


        $pythonScript = "/var/www/html/backend/addpet.py";
    
        // Escape special characters in the parameter
        $parameter = escapeshellarg($uploadFile);
    
        // Construct the command to run the Python script
        $email = $_SESSION['email'];
        $command = "python3 $pythonScript $parameter $email";


        // Execute the command and capture the output
        //$result = shell_exec($command);
        $result = trim(shell_exec($command));

        
    
        if (str_contains($result, '/var/www/html/backend/'.$email.'/crops/dog/')) {
            //$return_arr["message"] = $result . 'yes dog';

            if($_POST['pet_type']=='Cat'){
                $return_arr["status"] = 3;
                $return_arr["message"] = 'Wrong pet type';
                $return_arr["type"] = 'Dog';
                header('Content-Type: application/json');
                echo json_encode($return_arr);
                exit;
            }



            $uploadDir = '../uploads/pets/dog/'. $_SESSION['address'] .'/'. $_POST['pet_name'] . '/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            //copy the cut image from result to dog dir
            $sourceFile = $result;
            
            
            $destinationDir = '/var/www/html/uploads/pets/dog/'. $_SESSION['address'] .'/'. $_POST['pet_name'] . '/';

            // Check if the source file exists before attempting to copy
            if (file_exists($sourceFile)) {
                // Extract the filename from the source path
                $filename = basename($sourceFile);
                
                // Create the destination path by combining the destination directory and filename
                $destinationFile = $destinationDir . $filename;
                
                //from crop to pet or dog dir
                if (copy($sourceFile, $destinationFile)) {
                     // from crop to email path.
                    if(copy($sourceFile, $uploadFilesave)){
                        $return_arr["status"] = 1;
                        $return_arr["message"] = $uploadDir;

                        // save to database
                        include_once('dbconnect.php'); $sql = "INSERT INTO `pets` (
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
                            '$currentDateTime', 
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
                        $pet_img = $uploadFilesave;
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
                            $stmt->bindParam(':date_change', $currentDateTime);
                        
                            // Execute the statement
                            if($stmt->execute()){
                                $return_arr["status"] = 1;
                                $return_arr["message"] = 'ok na';
                            }


                        }


                    }
               
                } else {
                    $return_arr["status"] = 0;
                    $return_arr["message"] = 'Failed to copy the file.';
                }

            } else {
                $return_arr["status"] = 0;
                $return_arr["message"] = 'Source file does not exist.';
            }


        }else if(str_contains($result, '/var/www/html/backend/'.$email.'/crops/cat/')) {
            //$return_arr["message"] = $result . 'yes cat';

            $uploadDir = '../uploads/pets/cat/'. $_SESSION['address'] .'/'. $_POST['pet_name'] . '/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if($_POST['pet_type']=='Dog'){
                $return_arr["status"] = 3;
                $return_arr["message"] = 'Wrong pet type';
                $return_arr["type"] = 'Cat';
                header('Content-Type: application/json');
                echo json_encode($return_arr);
                exit;
            }

            //copy the cut image from result to dog dir
            $sourceFile = $result;
            
            
            $destinationDir = '/var/www/html/uploads/pets/cat/'. $_SESSION['address'] .'/'. $_POST['pet_name'] . '/';

            // Check if the source file exists before attempting to copy
            if (file_exists($sourceFile)) {
                // Extract the filename from the source path
                $filename = basename($sourceFile);
                
                // Create the destination path by combining the destination directory and filename
                $destinationFile = $destinationDir . $filename;
                
                //from crop to pet or dog dir
                if (copy($sourceFile, $destinationFile)) {
                     // from crop to email path.
                    if(copy($sourceFile, $uploadFilesave)){
                        $return_arr["status"] = 1;
                        $return_arr["message"] = $uploadDir;

                        // save to database
                        include_once('dbconnect.php'); $sql = "INSERT INTO `pets` (
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
                            '$currentDateTime', 
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
                        $pet_img = $uploadFilesave;
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
                            $stmt->bindParam(':date_change', $currentDateTime);
                        
                            // Execute the statement
                            if($stmt->execute()){
                                $return_arr["status"] = 1;
                                $return_arr["message"] = 'ok na';
                            }


                        }


                    }
               
                } else {
                    $return_arr["status"] = 0;
                    $return_arr["message"] = 'Failed to copy the file.';
                }

            } else {
                $return_arr["status"] = 0;
                $return_arr["message"] = 'Source file does not exist.';
            }



        }else{
            //delete the image

            unlink($uploadFile);
            $return_arr["status"] = 2;
            $return_arr["message"] = 'no detect dog or cat yow';

            
        }




    } else {
        // Error occurred during file upload
        $return_arr["status"] = 0;
        $return_arr["message"] = "Error uploading file.";
    }
} else {
    // If file or session data is missing
    $return_arr["status"] = 0;
    $return_arr["message"] = "File or session data missing.";
}



//deeelte
$directoryPath = '/var/www/html/backend/'.$email.'';

// Check if the directory exists
if (is_dir($directoryPath)) {
    // Use exec to run the rm command
    $command = "rm -rf $directoryPath";
    
    // Execute the command
    exec($command, $output, $exitCode);

    // Check the exit code to determine if the command was successful
    if ($exitCode === 0) {
        //echo 'Directory and its contents removed successfully.';
        
        //$return_arr["message"] = 'Directory and its contents removed successfully.';
    } else {
        //echo 'Error removing directory: ' . implode("\n", $output);
    }
} 




// Output JSON response
header('Content-Type: application/json');
echo json_encode($return_arr);

        


?>

