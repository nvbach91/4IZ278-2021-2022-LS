<?php

$logo = 'https://assets.faceit-cdn.net/teams_avatars/70e2d286-0819-4182-ac0c-baa4a88b8e12_1608250117890.jpg';
$firstName = 'Marko';
$lastName = 'Vanhanen';
$fullName = sprintf('%s %s', $firstName, $lastName);
$position = 'Professional cofe maker';
$birthDate = new DateTime('1986-03-05');
$phone = '+3580400471747';
$email = 'markovanhanen@luukku.com';
$diff = (new DateTime())->diff($birthDate);
$company = 'currently unemployed';
$street = 'Keiteleentie';
$orientationNumber = 'B4';
$descriptiveNumber = '2-4';
$city = 'Suolahti';
$website = 'https://www.youtube.com/channel/UCX1t6Vm0DsU95Q5JlsNM1vQ';
$available = true;
$address = sprintf('%s %s/%s, %s', $street, $descriptiveNumber, $orientationNumber, $city);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Businesscard</title>
</head>
<body>
    <div class="bc">
        <img src="<?= $logo ?>" alt="Marko">
        <h1><?= $fullName ?></h1>
        <h2><?= $position ?>, <?= $company ?></h2>
        <h3><?= $diff->y ?> years old</h3>
        <ul>
            <li><?= $address ?></li>
            <li><a href="mailto:<?= $email ?>"><?= $email ?></a></li>
            <li><a href="tel:<?= $phone ?>"><?= $phone ?></a></li>
            <li><a href="<?= $website ?>">Web</a></li>
            <li><?php echo $available ? 'Available' : 'Not available'?></li>
        </ul>
    </div>
</body>
</html>


