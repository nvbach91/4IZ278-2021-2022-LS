<?php
$logo = "https://cdn1.iconfinder.com/data/icons/data-science-1-1/512/20-512.png";
$firstname = "Josef";
$surname = "Katič";
$age = date_diff(date_create("24.11.2000"), date_create('now'))->y;;
$position = "Software Engineer/Student";
$company = "Company";
$street = "Ústecká";
$houseNumber = "26";
$orientationNumber = "860";
$city = "Děčín";
$phone = "+420 123 123 123";
$email = "katj00@vse.cz";
$companyEmail = "katj00@company.com";
$website = "eso.vse.cz/~katj00/cv01";
$applicable = false;


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CV01</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>This is my business card</h1>
<div class="business-card">
    <div class="business-card__wrapper">
        <div class="business-card__container">
            <div class="business-card__logo">
                <img src="<?php echo $logo ?>" alt="Logo">
            </div>
            <div class="business-card__name">
                <?php echo "{$firstname} {$surname}"; ?>
            </div>
            <div class="business-card__position"><?php echo "{$position}"; ?></div>
        </div>
    </div>
</div>
<div class="business-card">
    <div class="business-card__wrapper">
        <div class="business-card__container">
            <h2 class="business-card__name">
                <?php echo "{$firstname} {$surname}"; ?>
            </h2>
            <div class="business-card__info">
                <div class="business-card__contact">
                    Firma: <?php echo "{$company}" ?>
                </div>
                <div class="business-card__contact">
                    Věk: <?php echo "{$age}" ?>
                </div>
                <div class="business-card__contact">
                    Adresa: <?php echo "{$street} {$orientationNumber}/{$houseNumber} {$city}" ?>
                </div>
                <div class="business-card__contact">
                    Telefon: <?php echo "{$phone}" ?>
                </div>
                <div class="business-card__contact">
                    Email: <a href='<?php echo "mailto:{$email}" ?>'><?php echo "{$email}" ?></a>
                </div>
                <div class="business-card__contact">
                    Pracovní email: <a href='<?php echo "mailto:{$companyEmail}" ?>'><?php echo "{$companyEmail}" ?></a>
                </div>
                <div class="business-card__contact">
                    Web: <a href='<?php echo "{$website}" ?>'><?php echo "{$website}" ?></a>
                </div>
                <div class="business-card__contact">
                    <?php echo $applicable ? "Hledám práci" : "Práci momentálně nehledám"?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
