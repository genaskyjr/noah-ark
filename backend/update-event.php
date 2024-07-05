<?php
$response = array(
    'status' => 0,
    'message' => 'no action'
);

try {
    include 'dbconnect.php';

    if (
        isset($_POST['event_id']) &&
        isset($_POST['event_name']) &&
        isset($_POST['event_desc']) &&
        isset($_POST['event_date']) &&
        isset($_POST['event_time']) &&
        isset($_POST['event_location'])
    ) {
        $event_id = $_POST['event_id'];
        $event_name = $_POST['event_name'];
        $event_desc = $_POST['event_desc'];
        $event_date = $_POST['event_date'];
        $event_time = $_POST['event_time'];
        $event_location = $_POST['event_location'];

        $stmt = $conn->prepare('UPDATE events 
                               SET event_name = :name, 
                                   event_desc = :desc, 
                                   event_date = :date, 
                                   event_time = :time, 
                                   event_location = :location
                               WHERE event_id = :id');

        $stmt->bindParam(':id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $event_name, PDO::PARAM_STR);
        $stmt->bindParam(':desc', $event_desc, PDO::PARAM_STR);
        $stmt->bindParam(':date', $event_date, PDO::PARAM_STR);
        $stmt->bindParam(':time', $event_time, PDO::PARAM_STR);
        $stmt->bindParam(':location', $event_location, PDO::PARAM_STR);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $response = array(
                'status' => 1,
                'message' => 'sql inserted'
            );
        } else {
            $response = array(
                'status' => 1,
                'message' => 'sql error'
            );
        }

        if (isset($_FILES['event_image']) && $_FILES['event_image']['error'] == UPLOAD_ERR_OK) {
            $currentDateTime = date('YmdHis');
            $uploadDir = '../uploads/events/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $uploadfullDir = $uploadDir . $currentDateTime . $_FILES['event_image']['name'];

            if (move_uploaded_file($_FILES["event_image"]["tmp_name"], $uploadfullDir)) {
                $stmt = $conn->prepare('UPDATE events SET event_img = :img WHERE event_id = :id');
                $stmt->bindParam(':id', $event_id, PDO::PARAM_INT);
                $stmt->bindParam(':img', $uploadfullDir, PDO::PARAM_STR);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $response = array(
                        'status' => 1,
                        'message' => 'uploaded image and sql inserted'
                    );
                } else {
                    $response = array(
                        'status' => 1,
                        'message' => 'error inserting sql'
                    );
                }
            }
        }
    } else {
        $response = array(
            'status' => 0,
            'message' => 'fill out all forms except image'
        );
    }
} catch (PDOException $e) {
    $response = array(
        'status' => 0,
        'message' => 'Error: ' . $e->getMessage()
    );
}

header('Content-Type: application/json');
echo json_encode($response);
?>
