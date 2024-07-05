<?php 
include 'dbconnect.php';

try {
    // Calculate the dates for 1 month, 1 week, and 1 day before the current date
    $oneMonthBefore = date('Y-m-d', strtotime('+1 month'));
    $oneWeekBefore = date('Y-m-d', strtotime('+1 week'));
    $oneDayBefore = date('Y-m-d', strtotime('+1 day'));

    echo $oneMonthBefore;
    echo $oneWeekBefore;
    echo $oneDayBefore;

    // SQL query to fetch pets with vaccine dates 1 month, 1 week, or 1 day before the current date
    $sql = "SELECT p.*, u.`email`,u.`fullname` FROM `pets` p 
    JOIN `users` u ON p.`pet_owner` = u.`id` 
    WHERE p.`pet_next_vaccine` IN (:oneMonthBefore, :oneWeekBefore, :oneDayBefore)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':oneMonthBefore', $oneMonthBefore);
    $stmt->bindParam(':oneWeekBefore', $oneWeekBefore);
    $stmt->bindParam(':oneDayBefore', $oneDayBefore);
    $stmt->execute();

    // Loop through the results and perform actions (e.g., send email alerts)
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // For testing purposes, you can use echo statements or implement email sending logic here
        $to = $row['email'];
        $fullname = $row['fullname'];
        $subject = 'Vaccine Alert';
        $message = 'This is a reminder for your pet\'s vaccination on ' . $row['pet_next_vaccine'];

        echo "Email sent to: $to <br>"; // Display for testing


        //do mail

        // require 'vendor/autoload.php';

        // // Create a PHPMailer object
        // $mail = new PHPMailer\PHPMailer\PHPMailer();
        // $Exception = new PHPMailer\PHPMailer\Exception();
        
        // $mail->isSMTP();
        // $mail->Host = 'smtp.gmail.com';  //gmail SMTP server
        // $mail->SMTPAuth = true;
        // $mail->Username = 'genaskypinlac0@gmail.com';   //email
        // $mail->Password = 'suur xmhg gmiv aepk' ;   //16 character obtained from app password created
        // $mail->Port = 465;  //SMTP port
        // $mail->SMTPSecure = "ssl";

        // //sender information
        // $mail->setFrom('genaskypinlac0@gmail.com', 'Noah\'s Ark Dog & Cat Shelter');  // Fixed subject line here

        // //receiver email address and name
        // $mail->addAddress($email, $fullnamemo);  // Make sure to replace 'RECIPIENT_NAME' with actual name





    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
