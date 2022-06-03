<?php
function sendEmail($emailAdress, $subject, $message) {
    mb_internal_encoding("UTF-8");
    $head = 'From: ' . EMAIL_FROM;
    $head .= "\nMIME-Version: 1.0\n";
    $head .= "Content-Type: text/html; charset=\"utf-8\"\n";
    $success = mb_send_mail($emailAdress, $subject, $message, $head);
    if ($success)
    {
        return true;
        exit;
    }
    else {
        return false;
    }
}
?>