<?php

$name='Jan Hlavnička';
$position='VŠE Praha';
$phone="+420 123 456 789";
$email='hlaj13@vse.cz';
$website="https://www.abc.com";
//datum ve formátu dd/mm/yyyy
$birthDate = "30-12-1999";
$today = date("Y-m-d");
$diff = date_diff(date_create($birthDate), date_create($today));
$povolani = 'student';
$organisation = 'Vysoká škola ekonomická v Praze';
$address = 'Winstona Churchilla 123456, 1234, Praha 10';


?>

<html>
<head>
    <title>PHP Tutorials</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
<h1>This is my business card (front)</h1>
<div class="business-card">
    <div class='bc-name'><?php echo $name; ?></div>
    <div class='bc-position'><?php echo $povolani,' ', $position; ?></div>
    <hr><br>
    <div class='bc-phone'><a href="tel:<?php echo $phone ?>"><?php echo $phone; ?></a></div>
    <div class='bc-mail'><a href="mailto:<?php echo $email ?>"><?php echo $email; ?></a></div>
    <div class='bc-website'><a href="https://www.abc.com:<?php echo $website ?>"><?php echo $website; ?></a></div>
    <div class='bc-age'><?php echo "Věk: " . $diff->format('%y'); ?></div>
    <img src="fis-logo-e1539356169853_500x423_acf_cropped.png" alt="fis">
</div>
<h2> This is my business card (back)</h2>
<div class="business-card">

    <div class="bc-center">
        <div class='bcb-organisation'><?php echo $organisation; ?></div>
        <div class='bcb-address'><?php echo $address; ?></div>
    </div>

</div>
</body>
</html>