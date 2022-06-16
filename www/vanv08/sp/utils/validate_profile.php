<?php
$ideal_phone = '/^(\+[0-9]{3})?\s?([0-9]{3})\s?([0-9]{3})\s?([0-9]{3})$/';
$ideal_postal = '/^([0-9]{5})|([1-9][0-9]{2}\s[0-9]{2})$/';
$ideal_steet = '/^[\w\s]{2,}\s([0-9]{1,6}(\/[0-9]{1,5})?)$/';


if (strlen($first_name) < 2) {
    array_push($errors, 'First name is too short');
}

if (strlen($last_name) < 2) {
    array_push($errors, 'Last name is too short');
}

// ideal formats



if ($_POST['phone'] && !preg_match($ideal_phone, $phone)) {
    array_push($errors, 'Invalid phone format');
}

if ($_POST['postal'] && !preg_match($ideal_postal, $postal)) {
    array_push($errors, 'Invalid post code format');
}

if ($_POST['street'] && !preg_match($ideal_steet, $street)) {
    array_push($errors, 'Invalid street format');
}
