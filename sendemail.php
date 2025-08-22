<?php
// Include PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = $_POST['name'] ?? '';
    $email   = $_POST['email'] ?? '';
    $phone   = $_POST['phone'] ?? '';
    $message = $_POST['message'] ?? '';

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host       = 'server360.web-hosting.com'; // 👉 Replace with your SMTP server (e.g., smtp.hostinger.com, smtp.gmail.com)
        $mail->SMTPAuth   = false;
        $mail->Username   = 'Dmail'; // 👉 Replace with your SMTP email
        $mail->Password   = 'pas'; // 👉 Replace with your SMTP password
        $mail->Port       = 465; 
        $mail->SMTPSecure = 'ssl'; // If using TLS, change to 'tls' and port 587

        // Email settings
        $mail->setFrom('info@kuhukuhu.com', 'Kuhukuhu Productions Contact Form');
        $mail->addAddress('pan@gmail.com'); // 👉 Receiver email (same as above or another)

        $mail->Subject = "New Inquiry from $name";
        $mail->isHTML(true);

        // Email content
        $mailContent = '
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #ddd; padding: 20px;">
            <h2 style="color: #1976d2; text-align: center;">Kuhukuhu Productions</h2>
            <h3 style="text-align: center; color: #444;">New Contact Form Submission</h3>
            <hr style="border-top: 1px solid #ccc;">

            <p><strong>Name:</strong> ' . htmlspecialchars($name) . '</p>
            <p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>
            <p><strong>Phone:</strong> ' . htmlspecialchars($phone) . '</p>
            <p><strong>Message:</strong><br>' . nl2br(htmlspecialchars($message)) . '</p>

            <hr style="border-top: 1px solid #ccc;">
            <p style="font-size: 12px; color: #777; text-align: center;">
                This message was sent from the contact form on the Kuhukuhu Productions website.
            </p>
        </div>';

        $mail->Body = $mailContent;

        // Send the email
       if ($mail->send()) {
    echo '<p style="color: green;">✅ Thank you! Your message has been sent successfully.</p>';
} else {
    echo '<p style="color: red;">❌ Sorry, email could not be sent. Please try again later.</p>';
}


    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
} else {
    // Redirect if accessed directly
    header('Location: index.html');
    exit;
}
