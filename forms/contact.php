<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

header('Content-Type: text/plain'); // plain text for JS
ob_clean(); // remove accidental output

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'florencefactondev@gmail.com';
        $mail->Password   = 'lomj jghz mmtb dorh'; // app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('florencefactondev@gmail.com', 'Florence D. Facton');
        $mail->addReplyTo($email, $name);
        $mail->addAddress('florencefactondev@gmail.com', 'FlorPolio');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "<p><strong>Name:</strong> $name</p>
                          <p><strong>Email:</strong> $email</p>
                          <p><strong>Message:</strong><br>$message</p>";
        $mail->AltBody = "Name: $name\nEmail: $email\nMessage:\n$message";

        $mail->send();

        echo 'success';
    } catch (Exception $e) {
        echo 'error: ' . $mail->ErrorInfo;
    }
    exit;
} else {
    echo 'error: Invalid request.';
    exit;
}
