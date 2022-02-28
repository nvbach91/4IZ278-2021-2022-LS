<?php
$logo = 'logo.png';
$companyName = 'Company';
$name = 'First Last';
$age = '69';
$position = 'Water Dispenser';
$phone = '+420 123 456 789';
$email = 'mail@mai.com';
$website = 'https://www.aaaaaaa.com';
$street = 'Sesame Street';
$streetNumber = '123';
$city = 'Prague';
$available = 'available for work';
$address = $street . ' ' . $street . ' ' . $streetNumber;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Business Card</title>
</head>

<body>
    <h1>This is my business card</h1>
    <div class="business-card">
        <img class="bc-logo" src="./img/<?php echo $logo; ?>"></img>
        <div class="bc-name"><?php echo $name; ?></div>
        <div class="bc-age"><?php echo date("Y") - $age; ?></div>
        <div class="bc-position"><?php echo $position; ?></div>
        <div class="bc-phone"><a href="tel: <?php echo $phone; ?>"><?php echo $phone; ?></a></div>
        <div class="bc-email"><a href="mailto: <?php echo $email; ?>"><?php echo $email; ?></a></div>
        <div class="bc-website"><a target="_blank" href="<?php echo $website; ?>"><?php echo $website; ?></a></div>
        <div class="bc-address"><?php echo $address; ?></div>
        <div class="bc-status"><?php echo $available; ?></div>
    </div>
</body>

</html>