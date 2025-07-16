<?php
// Set your email address here
$to = "support@ihavetaxdebt.com";

// Check if POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $fullName = htmlspecialchars(trim($_POST["fullName"] ?? ''));
    $phone = htmlspecialchars(trim($_POST["phone"] ?? ''));
    $zipCode = htmlspecialchars(trim($_POST["zipCode"] ?? ''));
    $email = filter_var(trim($_POST["email"] ?? ''), FILTER_VALIDATE_EMAIL);
    $amountOwed = htmlspecialchars(trim($_POST["amountOwed"] ?? ''));
    $legalRep = htmlspecialchars(trim($_POST["legalRep"] ?? ''));
    $comments = htmlspecialchars(trim($_POST["comments"] ?? ''));

    // Basic validation
    if (!$fullName || !$phone || !$email || !$amountOwed || !$legalRep) {
        http_response_code(400);
        echo "Please fill in all required fields.";
        exit;
    }

    // Compose email
    $subject = "New Contact Form Submission";
    $message = "Full Name: $fullName\n";
    $message .= "Phone: $phone\n";
    $message .= "Zip Code: $zipCode\n";
    $message .= "Email: $email\n";
    $message .= "Amount Owed: $amountOwed\n";
    $message .= "Legal Representation: $legalRep\n";
    $message .= "Comments: $comments\n";

    $headers = "From: $email\r\nReply-To: $email\r\n";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "Thank you for contacting us! We will get back to you soon.";
    } else {
        http_response_code(500);
        echo "Sorry, there was a problem sending your message. Please try again later.";
    }
} else {
    http_response_code(403);
    echo "There was a problem with your submission. Please try again.";
}
?>
