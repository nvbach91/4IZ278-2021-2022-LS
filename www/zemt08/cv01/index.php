<?php
$fname = "Tomáš";
$lname = "Zeman";
$tel = "+420 777 888 999";
$email = "zemt08@vse.cz";
$job = "Front-end Developer";
$company = "SmartWebs";
$street = "Adresní";
$street_num = "1965";
$street_num2 = "23";
$city = "Praha";
$web = "smart-webs.cz";
$contracts = "Now available for contracts";

$birthDate = "12/17/1998";
//explode the date to get month, day and year
$birthDate = explode("/", $birthDate);
//get age from date or birthdate
$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    ? ((date("Y") - $birthDate[2]) - 1)
    : (date("Y") - $birthDate[2]));
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cviko 1</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/3e0b4c52d6.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles.css">
</head>

<body>
    <div class="cards">
        <section class="card">
            <img src="./logo.svg">
            <div class="main-info">
                <h1><?php echo $fname; ?></h1>
                <h1 style="color: #333;"><?php echo $lname; ?></h1>
                <h3><?php echo $job; ?></h3>
                <h2><?php echo $company; ?></h2>
            </div>
            <div class="object left"></div>
            <div class="object right"></div>
        </section>

        <section class="card back">
            <div class="main-info">
                <h1><?php echo $fname; ?></h1>
                <h1><?php echo $lname; ?></h1>
                <h3><?php echo $job; ?></h3>
                <h2><?php echo $company; ?></h2>
            </div>
            <div class="detail-info">
                <h3><i class="fa-solid fa-location-crosshairs fa-fw"></i><?php echo $street . " " . $street_num . "/" . $street_num2 . ", " . $city; ?></h3>
                <a href="tel:"><i class="fa-solid fa-mobile fa-fw"></i><?php echo $tel; ?></a>
                <a href="mailto:"><i class="fa-solid fa-envelope fa-fw"></i><?php echo $email; ?></a>
                <a target="_blank" href="https://smart-webs.cz"><i class="fa-solid fa-globe fa-fw"></i><?php echo $web; ?></a>
                <h3><i class="fa-solid fa-user-secret fa-fw"></i><?php echo $age . " let"; ?></h3>
                <h3><i class="fa-solid fa-handshake-angle fa-fw"></i><?php echo $contracts; ?></h3>
            </div>
        </section>
    </div>

</body>

</html>