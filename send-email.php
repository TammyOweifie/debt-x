<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fullName = htmlspecialchars(trim($_POST["fullName"]));
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $zipCode = htmlspecialchars(trim($_POST["zipCode"] ?? ''));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $amountOwed = htmlspecialchars(trim($_POST["amountOwed"]));
    $legalRep = htmlspecialchars(trim($_POST["legalRep"]));
    $comments = htmlspecialchars(trim($_POST["comments"] ?? ''));

    if (!$fullName || !$phone || !$email || !$amountOwed || !$legalRep) {
        http_response_code(400);
        echo "Please fill in all required fields.";
        exit;
    }

    $to = "support@ihavetaxdebt.com"; // Change to your actual recipient email
    $subject = "IRS Case Review Form Submission";
    $message = "
        <h2>IRS Case Review Submission</h2>
        <p><strong>Name:</strong> $fullName</p>
        <p><strong>Phone:</strong> $phone</p>
        <p><strong>Zip Code:</strong> $zipCode</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Amount Owed:</strong> $amountOwed</p>
        <p><strong>Legal Rep:</strong> $legalRep</p>
        <p><strong>Comments:</strong><br>" . nl2br($comments) . "</p>
    ";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: Website Form <no-reply@ihavetaxdebt.com>\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo "Your message has been sent successfully!";
    } else {
        http_response_code(500);
        echo "Failed to send email.";
    }
} else {
    http_response_code(405);
    echo "Method Not Allowed";
}
