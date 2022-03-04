<?php
require "Person.php";

$human1 = new Person(
        "vse.png",
        "Vše",
        "Daniel",
        "Hejna",
        2000,
        "Student",
        "774 416 609",
        "hejd02@vse.cz",
        "vse.cz",
        "nám. Winstona Churchilla",
        "1938/4",
        "Praha 3",
        "130 67"
);
$human2 = new Person(
        "ujep.gif",
        "Vše",
        "Daniel",
        "Hejna  V2",
        2000,
        "Student",
        "774 416 609",
        "hejd02@vse.cz",
        "ujep.cz",
        "Pasteurova",
        "3544/1",
        "Ústí nad Labem-město",
        "400 96"
);
$human3 = new Person(
        "cvut.png",
        "CVUT",
        "Daniel",
        "Hejna V3",
        2000,
        "Student",
        "774 416 609",
        "hejd02@vse.cz",
        "cvut.cz",
        "",
        "166 36",
        "Praha 6",
        "130 67"
);


$humanity = array($human1, $human2, $human3);


?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" />
    <title>Document</title>
</head>
<body>
    <?php foreach ($humanity as $human) : ?>
        <div class="human">
            <img src="<?php echo $human->getLogo() ?>" width="100" height="100" />

            <div class="info">
                <h1><?php echo $human->getFirstName().' '.$human->getLastName() ?></h1>
                <p><?php echo $human->getAge() ?> let</p>
                <p><?php echo $human->getAddress() ?></p>
                <p><?php echo $human->getCompanyName()   ?></p>
                <p><?php echo $human->getWebsite()   ?></p>
                <p><?php echo $human->getPosition() ?></p>
                <p><?php echo $human->getPhone() ?></p>
                <p><?php echo $human->getEmail() ?></p>

            </div>
        </div>
    <?php endforeach; ?>
</body>
</html>
