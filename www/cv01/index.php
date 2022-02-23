<?php

$logoURL = './images/boomerlogo.jpg';
$firstName = 'Boomer';
$lastName = 'Boomerovski';
$born = '10.12.1970';
$position = 'CEO of Boomers Inc.';
$corporation = 'Boomers Inc.';
$street = 'Long';
$streetNumber = '10/B';
$streetNumberOrient = '80';
$city = 'Boomtown';
$phone = '+420 123 456 789';
$email = 'bb@boomers.inc';
$website = 'https://en.wikipedia.org/wiki/OK_boomer';
$available = true;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/main.css" rel="stylesheet">
</head>
<body>
    
<h1>This is my business card</h1>
<div class="business-card">
    <div class="bc-logo"><img src="<?php echo $logoURL; ?>"></div>
    <div class="bc-name"><?php echo $firstName . ' ' . $lastName; ?></div>
    <div class="bc-age"><?php $yearOfBorn = substr($born, -4);
$age = date("Y") - $yearOfBorn;
echo $age . ' yo'; ?></div>
    <div class="bc-position"><?php echo $position; ?></div>
    <div class="bc-corporation"><?php echo $corporation; ?></div>
    <div class="bc-street"><?php echo $street . ' ' . $streetNumber . ' ' . $streetNumberOrient; ?></div>
    <div class="bc-city"><?php echo $city; ?></div>
    <div class="bc-phone"><a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></div>
    <div class="bc-email"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div>
    <div class="bc-website"><a target="_blank" href="<?php echo $website; ?>"><?php echo $website; ?></a></div>
    <div class="bc-available"><?php echo $available ? 'Open for new job offers!' : 'Not open for new job offers!'; ?></div>
</div>
</body>
</html>
