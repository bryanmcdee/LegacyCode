<?php
$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$message = trim($_POST["message"]);
$honeypotEmail = trim($_POST["honeypotEmail"]);
$formIsValid = true;
$errorMessage = "There was an error sending your email. Please try again."; 
 
if ($honeypotEmail != "") {
    $formIsValid = false;
    echo $errorMessage;
        exit;
}
 
$emailTo = "ENTER_YOUR_EMAIL_ADDRESS@gmail.com";
$subject = "New Message From Your Contact Form";
 
// email body 
$email_body = "";
$email_body .= "Name: " . $name . "\n";
$email_body .= "Email: " . $email . "\n";
$email_body .= "Message: " . $message  . "\n";;

// verify the contact form fields are not blank
if ($name == "" OR $email == "" OR $message == "") {
    $errorMessage = "You must specify a value for name, email address, and message.";
    $formIsValid = false;
}

// verify the message doesn't contain certain words
$invalidWords = array('www', '.com', 'http');

foreach($invalidWords as $word)
{
    if (strpos($message,$word) !== false) {
        $errorMessage = "Your message can't contain a link or email address.";
        $formIsValid = false;
        break;
    }
}

// send email
if ($formIsValid) {
    $success = mail($emailTo, $subject, $email_body, "From:".$email);
    if ($success){
        echo "success";
        exit;
    } else {
        echo $errorMessage;
        exit;
    }  
} else {
    echo $errorMessage;
    exit;
}
?>