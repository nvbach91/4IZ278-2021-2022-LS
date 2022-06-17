<?php
$to      = $email;
$subject = 'Registration';
$message = 'Registration success';
$headers = 'From: vanv08@vse.cz'       . "\r\n" .
             'Reply-To: vanv08@vse.cz' . "\r\n" .
             'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
echo $to; 
?>