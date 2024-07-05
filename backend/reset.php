<?php
$return_arr["status"] = 0;
$return_arr["message"] = "No Action.";

if(isset($_POST['code']) && isset($_POST['password']) && isset($_POST['password1'])) {
    $code = $_POST['code'];
    $password = $_POST['password'];
    $password1 = $_POST['password1'];

    if ($password === $password1) {
        include_once('dbconnect.php');

        $stmt = $conn->prepare("SELECT user_email, reset_code, is_valid FROM reset_codes WHERE reset_code = :reset_code");
        $stmt->bindParam(':reset_code', $code, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['is_valid'] == '0'){
            $return_arr["status"] = 2;
            $return_arr["message"] = 'Link Already Expired';
            echo json_encode($return_arr);
            exit(0);
        }

        if ($result) {
            $user_email = $result['user_email'];

            $stmt = $conn->prepare("UPDATE users SET password = :password WHERE email = :user_email");
            $stmt->bindParam(':password', $password1, PDO::PARAM_STR);
            $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);
            $return_arr["status"] = 1;
            $return_arr["message"] = $password1;

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $stmt = $conn->prepare("UPDATE reset_codes SET is_valid = :is_valid WHERE user_email = :user_email");
                    $is_valid = 0;
                    $stmt->bindParam(':is_valid', $is_valid, PDO::PARAM_INT);
                    $stmt->bindParam(':user_email', $user_email, PDO::PARAM_STR);

                    if ($stmt->execute()) {
                        $return_arr["status"] = 1;
                        $return_arr["message"] = "Password updated successfully.";
                    }
                } else {
                    $return_arr["message"] = "No records were updated.";
                }
            } else {
                $return_arr["message"] = "Error updating password: " . $stmt->errorInfo()[2];
            }
        } else {
            $return_arr["message"] = "Invalid reset code.";
        }
    } else {
        $return_arr["message"] = "Passwords do not match.";
    }
} else {
    $return_arr["message"] = "Fill all forms.";
}

echo json_encode($return_arr);
?>
