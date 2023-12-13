<?php

// Replace this with your own email address
$to = 'abdullah137751@gmail.com';

// Function to get the current URL
function getCurrentURL() {
    return sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['HTTP_HOST'],
        $_SERVER['REQUEST_URI']
    );
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize and trim form inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $contact_message = trim($_POST['message']);

    // Set a default subject if none is provided
    $subject = ($subject == '') ? "Contact Form Submission" : $subject;

    // Build the email message
    $message = "Email from: $name <br />";
    $message .= "Email address: $email <br />";
    $message .= "Message: <br />";
    $message .= nl2br($contact_message);
    $message .= "<br /> ----- <br /> This email was sent from your site " . getCurrentURL() . " contact form. <br />";

    // Set From: header
    $from = "$name <$email>";

    // Email Headers
    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    // Try to send the email
    $mail = mail($to, $subject, $message, $headers);

    // Check if the email was sent successfully
    if ($mail) {
        echo "OK";
    } else {
        echo "Something went wrong. Please try again.";
    }
}

?>
