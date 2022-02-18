<?php 
$avatar_url="https://gallery.lajtkep.dev/resources/db5d5e98c00dc5cc113b195441395f06e35685edb622986e44f63882d8757d4a.jpg";
$last_name = "Lajtkep";
$first_name = "Matěj";
$time_zone  = new DateTimeZone('Europe/Brussels');
$age = DateTime::createFromFormat('j-M-Y', '5-Oct-2000')->diff(new DateTime('now', $time_zone))->y;
$job = "Fullstack developer";
$company_name = "xDent";
$street = "Duch█████ ███";
$post = "4██ █3";
$house_number = "███";
$city = "Teplice";
$phone = "+420 735 ███ ███";
$email = "matej.lajtkep@gmail.com";
$web = "https://lajtkep.dev";
$job_ready = true;
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Moje vizitka</title>
</head>
<body class="💪">
    <div class="card">
        <img src="<?php echo $avatar_url ?>">
        <span class="firstname">Jméno: <?php echo $first_name ?></span>
        <span class="lastname">Příjmení: <?php echo $last_name ?></span>
        <span class="job">Práce: <?php echo $job ?></span>
        <span class="work">Firma: <?php echo $company_name ?></span>
        <span class="age">Věk: <?php echo $age ?></span>
    </div>

    <div class="card">
        <h2>Kontakt</h2>
        <span class="email">Email: <a href="<?php echo "mailto:".$email ?>"><?php echo $email ?></a></span>
        <span class="phone">Telefon: <a href="<?php echo "tel:".$phone ?>"><?php echo $phone ?></a></span>
        <span class="web">Web: <a target="_blank" href="<?php echo $web ?>"><?php echo $web ?></a></span>
        <span class="jobReady"> <?php echo $job_ready ? "Hledám práci" : "Prici momentálně nehledám" ?></span>
        <span class="address">Adresa: <?php echo $street.",".$city.",".$post ?> Barák číslo: <?php echo $house_number ?></span>
    </div>
</body>
</html>