<?php
$usersDB->updateAllbyId($firstName, $lastName, $phone, $street, $city, $postalCode, $_SESSION['user_id']);
$_SESSION['user_first_name'] = $firstName;
