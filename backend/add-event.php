<?php 

$response = array(
    'status' => 0,
    'message' => 'no action'
);

if(isset($_POST['event_name']) &&
isset($_POST['event_desc']) &&
isset($_POST['event_date']) &&
isset($_POST['event_time']) &&
isset($_POST['event_location']) &&
isset($_FILES['event_image'])
){

    $response = array(
        'status' => 1,
        'message' => 'RECIEVED'
    );


    $event_name = $_POST['event_name'];
    $event_desc = $_POST['event_desc'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $event_location = $_POST['event_location'];
    $event_image_name = $_FILES['event_image']['name'];


    $currentDateTime = date('YmdHis'); // Y - Year, m - Month, d - Day, H - Hours, i - Minutes, s - Seconds

    $uploadDir = '../uploads/events/';

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    //dir+current+file
    $uploadfullDir = $uploadDir . $currentDateTime . $event_image_name;

    

    if(move_uploaded_file($_FILES["event_image"]["tmp_name"], $uploadfullDir)){
        $response = array(
            'status' => 1,
            'message' => 'uploaded'
        );

        //image uploaded do sql insert

        include 'dbconnect.php';
        $event_name = $_POST['event_name'];
        $event_desc = $_POST['event_desc'];
        $event_date = $_POST['event_date'];
        $event_time = $_POST['event_time'];
        $event_location = $_POST['event_location'];
        $event_image_dir = $uploadfullDir;

        $stmt = $conn->prepare("INSERT INTO events (event_name, event_desc, event_date, event_time, event_location, event_img) VALUES (:event_name, :event_desc, :event_date, :event_time, :event_location, :event_img)");

        // Bind parameters
        $stmt->bindParam(':event_name', $event_name);
        $stmt->bindParam(':event_desc', $event_desc);
        $stmt->bindParam(':event_date', $event_date);
        $stmt->bindParam(':event_time', $event_time);
        $stmt->bindParam(':event_location', $event_location);
        $stmt->bindParam(':event_img', $event_image_dir);

        $stmt->execute();

       

        if($stmt->rowCount()){
            $response = array(
                'status' => 1,
                'message' => 'uploaded image and sql inserted'
            );
        }else{
            $response = array(
                'status' => 1,
                'message' => 'error inserting sql'
            );
        }






    }

    


   


    


}


// Set the Content-Type header to indicate JSON response
header('Content-Type: application/json');

// Encode the response array to JSON and output it
echo json_encode($response);



?>