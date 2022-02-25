<?php


$myName = 'Van Nguyen';
$myPosition = 'Cleaner';
$myPhone = '666222111';
$myEmail = 'van.nguyen@vantheman.com';
$myWebsite = 'vantheman.com';
$myCompany = "Van the Man inc.";
$myStreet = 'Sookin';
$myStreetNumber = 42;
$myOrientNumber = 55;
$myCity = 'Mejto';
$myJobStatus = 'Not available';
$photo = 'guy.jpeg';

$myBirthDate = '20-10-1999';
$currentDate = date('d-m-Y');

$age = date_diff(date_create($myBirthDate), date_create($currentDate));
$adress = $myStreet . ' ' . $myStreetNumber . '/' . $myOrientNumber . ', ' . $myCity;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./assets/styles/main.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Cviceni 01</title>
</head>

<body>
    <h1>Personal business card</h1>
    <div class="businnes-card">
        <div class="bc-image"><a
                href="https://angloville.com/wp-content/uploads/2017/11/Thegreaststockphotoguycomp_d534e3_5270001.jpg"
                target="_blank">
                <img src="./assets/img/<?php echo $photo; ?>" alt="photo"></a></div>
        <div class="bc-name">
            <?php echo $myName?> </div>
        <div class="bc-age>">
            <?php echo $age->format("%y")?>
        </div>
        <div class="bc-position">
            <?php echo $myPosition?> </div>
        <div class="bc-phone">
            <a href="tel: <?php echo $myPhone; ?>">
                <?php echo $myPhone; ?> </a>
        </div>
        <div class="bc-email">
            <a href="mailto: <?php echo $myEmail; ?>">
                <?php echo $myEmail; ?> </a>
        </div>
        <div class="bc-website">
            <a href="_blank: <?php echo $myWebsite; ?>">
                <?php echo $myWebsite; ?> </a>
        </div>
        <div class="bc-company">
            <?php echo $myCompany?> </div>
        <div class="bc-adress">
            <?php echo $adress?> </div>
        <div class="bc-myJobStatus" ?>
            <?php echo $myJobStatus?> </div>
    </div>

</body>

</html>