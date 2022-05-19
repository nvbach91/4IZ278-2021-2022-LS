<?php

// delimiter used in CSVs
// define('DELIMITER', ';');

// define('DB_FILE_USERS', dirname(__FILE__) . '/../database/users.db');

// used to send mails
define('SERVER_USER_NAME', 'muso00');

// the address of the sender
$sender = SERVER_USER_NAME . '@vse.cz';

// login page URL
define('PAGE_LOGIN', './signin.php');

// associative array to keep email templates
$emailTemplates = [
    'headers' => [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=utf-8',
        'From: ' . $sender,
        'Reply-To: ' . $sender,
        'X-Mailer: PHP/'.phpversion()
    ],
    'Registration confirmation' => function ($recipient) {
        return (
            "<h2>Hi Customer!</h2>" .
            "<p>Thank you for signing up on our website!</p>" .
            "<p><strong>You registered email:</strong> <a href='mailto:$recipient'>$recipient</a>.</p>" .
            "<p>You can now sign in <a href='https://eso.vse.cz/~muso00/sp/signin.php'>here</a>.</p>" . "<br>" .
            "<p>Your,</p>" .
            "<p>Team Liquor Town</p>"
        );
    },
    'Order confirmation' => function ($recipient) {
        return (
            "<h2>Hi Customer!</h2>" .
            "<p>Thank you for creating the order.</p>" .
            "<p>You can view the summary of your order on your profile. <a href='https://eso.vse.cz/~muso00/sp/profile.php'>Click here</a></p>" . "<br>" .
            "<p>Your,</p>" .
            "<p>Team Liquor Town</p>"
        );
    },
];

?>