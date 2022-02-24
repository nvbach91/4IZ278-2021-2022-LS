<?php
$logo = './img1.png';
$surName = 'Homer';
$secondName = 'Simpson';
$dateOfBirth = '12-5-1956';
$position = 'Manager';
$company = ' Springfield Nuclear Powerplant';
$street = 'Main Street';
$streetNo = '12';
$streetNo2 = '38312';
$city = 'Springfield';
$phone = '555-7334';
$email = 'homer@simpson.com';
$website = 'www.springfieldnuclear.com';
$availability = 'unavailable';

$currentDate = date("d-m-Y");
$age = date_diff(date_create($dateOfBirth), date_create($currentDate));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Business Card</title>
    <link href="./main.css" rel="stylesheet">
</head>
<body>
    <h1>This is my business card:</h1>
    <div class="business-card">
        <div class="left">
            <div class="bc-img"><img src="<?php echo $logo ?>" alt="x"></div>
        </div>
        <div class="right">
            <div class="bc-name"> <?php echo $surName . ' ' . $secondName ?>  </div>
            <div class="bc-age"> <?php echo 'Age: ' . $age->format("%y") ?> </div>
            <div class="bc-position"> <?php echo $position . ' in ' . $company?>  </div>
            <div class="bc-address"> <?php echo $street . ' ' . $streetNo . ', ' . $streetNo2 . ', ' . $city ?> </div>
            <div class="bc-phone"> <a href="tel:555-7334"> <?php echo $phone ?> </a> </div>
            <div class="bc-email">   <a href="mailto:simpson@springfeildnuclear.com"><?php echo $email ?></a> </div>
            <div class="bc-website"> <a href="www.springfieldnuclear.com/contacts"> <?php  echo $website ?> </a> </div>
            <div class="bc-availability"> <?php echo 'Currently ' . $availability . ' for job offers'?> </div>
        </div> 
    </div>
</body>
</html>