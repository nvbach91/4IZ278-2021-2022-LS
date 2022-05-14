<?php
$xname = 'muso00';
$sender = $xname . '@vse.cz';

$emailTemplates = [
    'headers' => [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=utf-8',
        'From: ' . $sender,
        'Reply-To: ' . $sender,
        'X-Mailer: PHP/'.phpversion()
    ],
    'Registration confirmation' => function ($recipient) {
        return ("
            <h2>Registration confirmation</h2>
            <p>Thank you for signing up!</p>
            <h4>You registered email:</h4>
            <p><a href='mailto:$recipient'>$recipient</a></p>
        ");
    },
];

function sendEmail($recipient, $subject) {
    // access variables from outside using keyword global
    global $emailTemplates;
    $headers = implode('\r\n', $emailTemplates['headers']);
    $message = $emailTemplates[$subject]($recipient);
    return mail($recipient, $subject, $message, $headers);
};

?>
