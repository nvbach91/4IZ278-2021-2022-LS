<?php

$ideal_pass = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,32}$/';


// email val
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    array_push($errors, 'Invalid Email');
}
// password val

if (!preg_match($ideal_pass, $password)) {
    array_push($errors, 'Invalid format');
}

if ($password !== $re_password) {
    array_push($errors, 'Passwords not matching');
}
?>