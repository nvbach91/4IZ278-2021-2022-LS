<?php
$phoneReq = '/^(\+[0-9]{3})?\s?([0-9]{3})\s?([0-9]{3})\s?([0-9]{3})$/';
$postCodeReq = '/^([0-9]{5})|([1-9][0-9]{2}\s[0-9]{2})$/';
$streetReq = '/^[\w\s]{2,}\s([0-9]{1,6}(\/[0-9]{1,5})?)$/';

if ($_POST['phone'] && !preg_match($phoneReq, $phone)) {
    array_push($errors, 'Wrong phone number format.');
}

if ($_POST['postalCode'] && !preg_match($postCodeReq, $postalCode)) {
    array_push($errors, 'Wrong post code number format.');
}

if ($_POST['street'] && !preg_match($streetReq, $street)) {
    array_push($errors, 'Wrong street format.');
}
