<?php require_once __DIR__ . '/email-config.php'; ?>
<?php

function sendEmail($recipient, $subject) {
    // access variables from outside using keyword global
    global $emailTemplates;
    $headers = implode("\r\n", $emailTemplates['headers']);
    $message = $emailTemplates[$subject]($recipient);
    return mail($recipient, $subject, $message, $headers);
};

function sumArrayVars($array, $arrayColumm)
{
    $res = array_sum(array_column($array, "$arrayColumm"));
    return $res;
}
