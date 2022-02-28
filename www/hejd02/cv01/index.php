<?php
$name = "Daniel Hejna";
$profese = "Student FIS";
$firma = "Fakulta informatiky a statistiky";
$email = "hejd02@vse.cz";
$web = "fis.vse.cz";
$tel = "654524125";
$dateOfBirth = "16-11-2000";
$today = date("Y-m-d");
$diff = date_diff(date_create($dateOfBirth), date_create($today));

$ulice = "Winstona Churchilla";
$psc = "130 67";
$cislo_orientacni = "1938/4";
$mesto = "Praha";

?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;1,300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="main.css"/>

<div class="businessCard">
    <div class="logo">
        <img src="logo.png" />
    </div>
    <div class="name">
        <h1><?php echo $name; ?></h1>
        <span><?php echo $profese; ?></span>
    </div>
    <div class="info">
        <ul>
            <li><?php echo $diff->format('%y') ?> let</li>
            <li><?php echo $profese; ?></li>
            <li><?php echo $firma; ?></li>
            <li><?php echo $mesto; ?></li>
            <li><?php echo $ulice; ?></li>

            <li><?php echo $cislo_orientacni; ?></li>
            <li><?php echo $psc; ?></li>
            <li><a href="tel:<?php echo $tel; ?>"><?php echo $tel; ?></a></li>
            <li><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></li>
            <li><a href="https://<?php echo $web; ?>"><?php echo $web; ?></a></li>
        </ul>
    </div>
</div>
