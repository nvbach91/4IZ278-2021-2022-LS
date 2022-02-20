<?php
$firstName = 'Marshall';
$secondName = 'Mathers';
$position = 'Rapper';
$phone = '+313 313 313 313';
$email = 'realslimshady@mathers.com';
$website = 'https://momsspaghetti.com';
$companyName = 'Marshall Records Inc.';
$street = 'B-rabbit Av.';
$buildingIdentNum = '21222';
$houseNum = '87';
$city = 'Chicago';
$img = 'em.jpeg';
$available = false;


$photo = 'em.jpeg';
$birthDate = '17-10-1972';
$currentDate = date('d-m-Y');
$age = date_diff(date_create($birthDate), date_create($currentDate));

$fullName = "$firstName $secondName";
$address = "$street $buildingIdentNum/$houseNum, $city";

$hiddenMessage = "Everybody from the 313 put your mf hands up and follow me!";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ondrej Musil">
    <title>HW01: business card</title>
    <link href="./assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" 
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon.png">
</head>

<body>
    <h1>This is my <span class="headline">business card</span></h1>
    <div class="business-card">
        <div class="bc-image"><a href="https://shady.fandom.com/wiki/Marshall_Mathers?file=Mars.jpg" target="_blank">
                <img src="./assets/img/<?php echo $photo; ?>" alt="photo"></a></div>
        <div class="bc-text-content">
            <div class="bc-name"><?php echo $fullName; ?></div>
            <div class="bc-age"><?php echo $age->format('%y') . ','; ?></div>
            <div class="bc-position"><?php echo $position; ?></div>
            <div class="bc-company"><?php echo $companyName; ?></div>
            <div class="bc-address"><?php echo $address; ?></div>
            <div class="contact bc-phone"><i class="fa fa-phone" title="<?php echo $hiddenMessage; ?>"></i>
                &nbsp;<a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></div>
            <div class="contact bc-email"><i class="fa fa-envelope"></i>
                &nbsp;<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div>
            <div class="contact bc-website"><i class="fa fa-globe"></i>
                &nbsp;<a href="<?php echo $website; ?>" target="_blank"><?php echo $website; ?></a></div>
            <div class="bc-available"><?php echo $available ? 'Available for contracts' : 'Not available for contracts'; ?></div>
        </div>
    </div>
</body>

</html>