<?php 
session_start();

// Initialize the response array
$return_arr["status"] = 0;
$return_arr["message"] = "No Action.";

// Check if all required fields are set
if (
    isset($_POST['pet_name']) &&
    isset($_POST['pet_gender']) &&
    isset($_POST['pet_birthday']) &&
    isset($_POST['pet_type']) &&
    isset($_POST['pet_last_vaccine']) &&
    isset($_POST['pet_next_vaccine']) &&
    isset($_POST['pet_id']) &&
    isset($_POST['pet_img'])
) {

    
    if($_SESSION['uploadedimageName'] == null){
        $_SESSION['uploadedimageName'] = $_POST['pet_img'];
    }
 

    include_once('dbconnect.php'); // Assuming dbconnect.php contains your database connection


    $newValue1 = $_POST['pet_name'];
    $newValue2 = $_POST['pet_gender'];
    $newValue3 = $_POST['pet_birthday'];
    $newValue4 = $_POST['pet_type'];
    $newValue5 = $_SESSION['uploadedimageName'];
    $newValue6 = $_POST['pet_last_vaccine'];
    $newValue7 = $_POST['pet_next_vaccine'];
    $newValue8 = $_POST['pet_id'];

    
	
	if($_SESSION['is_role']=='admin'){
		$stmt = $conn->prepare("UPDATE `pets` SET 
        pet_owner = :value0, 
        pet_name = :value1, 
        pet_gender = :value2, 
        pet_birthday = :value3, 
        pet_type = :value4, 
        pet_img = :value5, 
        pet_last_vaccine = :value6, 
        pet_next_vaccine = :value7 
        WHERE pet_id = :value8");
		

        $newValue0 = $_POST['pet_owner'];
        $stmt->bindParam(':value0', $newValue0, PDO::PARAM_INT);
		$stmt->bindParam(':value1', $newValue1, PDO::PARAM_STR);
		$stmt->bindParam(':value2', $newValue2, PDO::PARAM_STR);
		$stmt->bindParam(':value3', $newValue3, PDO::PARAM_STR);
		$stmt->bindParam(':value4', $newValue4, PDO::PARAM_STR);
		$stmt->bindParam(':value5', $newValue5, PDO::PARAM_STR);
		$stmt->bindParam(':value6', $newValue6, PDO::PARAM_STR);
		$stmt->bindParam(':value7', $newValue7, PDO::PARAM_STR);
		$stmt->bindParam(':value8', $newValue8, PDO::PARAM_STR);
	
	
	}else{

        
        $stmt = $conn->prepare("UPDATE `pets` SET 
        pet_name = :value1, 
        pet_gender = :value2, 
        pet_birthday = :value3, 
        pet_type = :value4, 
        pet_img = :value5, 
        pet_last_vaccine = :value6, 
        pet_next_vaccine = :value7 
        WHERE pet_id = :value8 AND pet_owner = :value9");
    
        $stmt->bindParam(':value1', $newValue1, PDO::PARAM_STR);
        $stmt->bindParam(':value2', $newValue2, PDO::PARAM_STR);
        $stmt->bindParam(':value3', $newValue3, PDO::PARAM_STR);
        $stmt->bindParam(':value4', $newValue4, PDO::PARAM_STR);
        $stmt->bindParam(':value5', $newValue5, PDO::PARAM_STR);
        $stmt->bindParam(':value6', $newValue6, PDO::PARAM_STR);
        $stmt->bindParam(':value7', $newValue7, PDO::PARAM_STR);
        $stmt->bindParam(':value8', $newValue8, PDO::PARAM_STR); // Assuming pet_id is an integer
        $stmt->bindParam(':value9', $_SESSION['id'], PDO::PARAM_INT);
    
        
		
	}



	


    if ($stmt->execute() > 0) {


        if($_SESSION['is_role']=='admin'){

            $stmt = null;
            //save change owner ship history

            $oldOwner = $_POST['pet_owner_current'];
            $newOwner = $_POST['pet_owner'];
            $dateChange = date('Y-m-d H:i:s'); // Use date() function to get the current timestamp

            $pet_id = $_POST['pet_id'];


            if($oldOwner!=$newOwner){
                $sql = "INSERT INTO `change_owner` (`pet_id`,`old_owner`, `new_owner`, `date_change`) VALUES (:pet_id, :old_owner, :new_owner, :date_change)";

            // Prepare the statement
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':pet_id', $pet_id);
            $stmt->bindParam(':old_owner', $oldOwner);
            $stmt->bindParam(':new_owner', $newOwner);
            $stmt->bindParam(':date_change', $dateChange);

            // Execute the statement
            $stmt->execute();

            $return_arr["status"] = 1;
            $return_arr["message"] = "Pet Updated Successfully. admin";

            }

       
            
        }else{
            $return_arr["status"] = 1;
            $return_arr["message"] = $newValue8 . $_SESSION['id'];
        }

        
        //clear session
        $_SESSION['uploadedimageName'] = null;


    } else {
        $return_arr["status"] = 2;
        $return_arr["message"] = "Error updating pet: " . $stmt->errorInfo()[2];
    }

    //do image cut



    $uploadFile = $newValue5;

    $pythonScript = "/var/www/html/backend/cut.py";
    
    $parameter = escapeshellarg($uploadFile);

    $command = "python3 $pythonScript $parameter";
    $result = trim(shell_exec($command));



    try {
        //$pet_img = '/path/to/your/pet/image.jpg'; // Replace with the actual path to your pet image
        //$result = '/path/to/your/result/image.jpg'; // Replace with the actual path to your result image
    
        if (file_exists($uploadFile)) {
            // Remove the old pet image
            unlink($uploadFile);
    
            // Copy the new image to the pet image location
            if (copy($result, $uploadFile)) {
                $return_arr["status"] = 1;
                $return_arr["message"] = 'File replaced successfully.';
                
                // do clean up
                

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




} else {
    $return_arr["status"] = 3;
    $return_arr["message"] = "Fill out all forms";
}


// do clean up
$directoryPath = '/var/www/html/backend/cropped_images';

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
