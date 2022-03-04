<?php
require("./Person.php");

$person1 = new Person("Tomáš", "Zeman", "+420 777 888 999", "zemt08@vse.cz", "Front-end Developer", "SmartWebs", "Adresní", "3285", "22", "Praha", "smart-webs.cz", "Not available for contracts", 1998);
$person2 = new Person("Radek", "Zeman", "+420 777 555 333", "zemr01@vse.cz", "Back-end Developer", "SmartWebs", "Ulická", "3486", "28", "Praha", "smart-webs.cz", "Not available for contracts", 1970);
$person3 = new Person("Jakub", "Zeman", "+420 777 888 999", "zemj06@vse.cz", "UX Designer", "SmartWebs", "Popelářská", "3784", "38", "Praha", "smart-webs.cz", "Not available for contracts", 1995);
$array = array($person1, $person2, $person3);
?>

<div class="cards">
    <?php foreach ($array as $person) : ?>
        <section class="card">
            <img src="./logo.svg">
            <div class="main-info">
                <h1><?= $person->getFirstName() ?></h1>
                <h1 style="color: #333;"><?= $person->getLastName() ?></h1>
                <h3><?= $person->getJob() ?></h3>
                <h2><?= $person->getCompany() ?></h2>
            </div>
            <div class="object left"></div>
            <div class="object right"></div>
        </section>

        <section class="card back">
            <div class="main-info">
                <h1><?= $person->getFirstName() ?></h1>
                <h1><?= $person->getLastName() ?></h1>
                <h3><?= $person->getJob() ?></h3>
                <h2><?= $person->getCompany() ?></h2>
            </div>
            <div class="detail-info">
                <h3><i class="fa-solid fa-location-crosshairs fa-fw"></i><?= $person->getAddress() ?></h3>
                <a href="tel:"><i class="fa-solid fa-mobile fa-fw"></i><?= $person->getTel() ?></a>
                <a href="mailto:"><i class="fa-solid fa-envelope fa-fw"></i><?= $person->getEmail() ?></a>
                <a target="_blank" href="https://smart-webs.cz"><i class="fa-solid fa-globe fa-fw"></i><?= $person->getWeb() ?></a>
                <h3><i class="fa-solid fa-user-secret fa-fw"></i><?= $person->getAge() ?></h3>
                <h3><i class="fa-solid fa-handshake-angle fa-fw"></i><?= $person->getAvailable() ?></h3>
            </div>
        </section>
    <?php endforeach; ?>
</div>