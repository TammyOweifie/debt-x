<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $fullName = htmlspecialchars(trim($_POST["fullName"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $zipCode = htmlspecialchars(trim($_POST["zipCode"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $amountOwed = htmlspecialchars(trim($_POST["amountOwed"]));
    $legalRep = htmlspecialchars(trim($_POST["legalRep"]));
    $comments = htmlspecialchars(trim($_POST["comments"]));

    // Validate required fields
    if (empty($fullName) || empty($phone) || empty($email) || empty($amountOwed) || empty($legalRep)) {
        http_response_code(400);
        echo "Please fill in all required fields.";
        exit;
    }

    // Prepare email
    $to = "your@email.com";  // Replace with your destination email
    $subject = "New IRS Case Review Submission";
    $message = "
    <html>
    <head>
      <title>IRS Case Review Submission</title>
    </head>
    <body>
      <h2>New Case Review Form Submission</h2>
      <p><strong>Full Name:</strong> $fullName</p>
      <p><strong>Phone:</strong> $phone</p>
      <p><strong>Zip Code:</strong> $zipCode</p>
      <p><strong>Email:</strong> $email</p>
      <p><strong>Amount Owed:</strong> $amountOwed</p>
      <p><strong>Legal Representation:</strong> $legalRep</p>
      <p><strong>Additional Comments:</strong><br/>" . nl2br($comments) . "</p>
    </body>
    </html>";

    // Set headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: <$email>" . "\r\n";

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        http_response_code(200);
        echo "Message sent successfully!";
    } else {
        http_response_code(500);
        echo "Message could not be sent.";
    }
} else {
    http_response_code(403);
    echo "Invalid request.";
}
