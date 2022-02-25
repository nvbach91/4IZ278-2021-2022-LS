<!DOCTYPE html>
<html lang="en">
<head>
    <title>Marek Mikula | 4iz278 | cv. 1</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php

$firstname = "Marek";
$lastname = "Mikula";
$fullName = "$firstname $lastname";

$street = "V Horkách 7";
$zip = "14000";
$city = "Praha";
$fullAddress = "$street, $city, $zip";

$position = "fullstack-dev";
$company = "DAMI development";
$phone = "775736759";
$email = "marek.mikula01@gmail.com";
$web = "https://github.com/marek-mikula";
$openedToOffer = true;

$birthdayDate = "1999-01-05"; // in format YYYY-MM-DD

$timezone = new DateTimeZone("Europe/Prague");
$currentDate = new DateTimeImmutable("now", $timezone);
$birthDate = DateTimeImmutable::createFromFormat("Y-m-d", $birthdayDate, $timezone);

$age = $currentDate->diff($birthDate)->y;

?>
<div class="card">
    <div class="card__section">
        <div class="card__section__item card__section__item--name"><?= $fullName ?></div>
        <div class="card__section__item card__section__item--position"><?= $position ?></div>
        <div class="card__section__item card__section__item--company"><?= $company ?></div>
    </div>
    <div class="card__section">
        <div class="card__section__item card__section__item--age"><?= $age ?> let</div>
        <div class="card__section__item card__section__item--phone"><?= $phone ?></div>
        <div class="card__section__item card__section__item--address"><?= $fullAddress ?></div>
    </div>
    <div class="card__section card__section--link">
        <div class="card__section__item card__section__item--link">
            <a href="mailto:<?= $email ?>"><?= $email ?></a>
        </div>
        <div class="card__section__item card__section__item--link">
            <a href="<?= $web ?>"><?= $web ?></a>
        </div>
    </div>
    <div class="card__section">
        <div class="card__section__item card__section__item--status <?= $openedToOffer ? 'card__section__item--opened' : 'card__section__item--not-opened' ?>">
            <?= $openedToOffer ? 'Opened for offers' : 'Currently not looking for a job' ?>
        </div>
    </div>
</div>
</body>
</html>
