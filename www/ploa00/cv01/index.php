<?php


$avatar = 'https://media.vogue.fr/photos/5fbbdfd569406dbb7ff1ca7c/1:1/w_2537,h_2537,c_limit/010_A7A11280_145.jpg';
$name = 'Ryan Gosling';
$currentYear = '2022';
$birthYear = '1980';
$age = $currentYear - $birthYear;
$position = 'Actor';
$firm = 'Hollywood';
$adress = 'Los Angeles, California';
$phone = '+420 228 014 880';
$email = 'ryan.gosling@gmail.com';
$website = 'https://www.ryangosling.com';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./style.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300&display=swap" rel="stylesheet" />
</head>

<body>
    <h1> This is my business card </h1>
    <div class="business-card">
        <div class="bc-avatar"> <img src="<?php echo $avatar; ?>"></div>
        <div class="bc-content">
        <div class="bc-name"> <?php echo $name; ?></div>
        <div class="bc-age"> <p>age: <?php echo $age; ?></p></div>
        <div class="bc-firm"> <p>firm: <?php echo $firm; ?></p></div>
        <div class="bc-position"><p>position: <?php echo $position; ?></p></div>
        <div class="bc-adress"> <p>adress: <?php echo $adress; ?></p></div>
        <div class="bc-phone">
            <a href="tel: <?php echo $phone; ?>"><?php echo $phone; ?></a>
        </div>
        <div class="bc-email">
            <a href="mailto: <?php echo $email; ?>"><?php echo $email; ?></a>
        </div>
        <div class="bc-website">
            <a target="link:" href="=<?php echo $website; ?>"><?php echo $website; ?></a>
        </div>
        </div>
    </div>
</body>

</html>