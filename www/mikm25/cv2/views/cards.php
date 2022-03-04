<?php

require_once __DIR__ . '/../models/Person.php';

/** @var list<Person> $persons */
$persons = [];

$persons[] = new Person(
    "Marek",
    "Mikula",
    "V Horkách 7",
    "14000",
    "Praha 4",
    "fullstack-dev",
    "DAMI development",
    "775736759",
    "marek.mikula01@gmail.com",
    "https://github.com/marek-mikula",
    false,
    "1999-01-05"
);
$persons[] = new Person(
    "Vladimír",
    "Putin",
    "Moskevská 78",
    "10069",
    "Moskva",
    "qa-tester",
    "Specnaz",
    "123456789",
    "vlad.putin@gmail.com",
    "https://github.com/vlad-putin",
    true,
    "1952-10-07"
);
$persons[] = new Person("Madeup",
    "Name",
    "Random 95",
    "98709",
    "Praha",
    "devops",
    "Cryfin",
    "987678567",
    "random@gmail.com",
    "https://github.com/random",
    false,
    "1982-10-07"
);
$persons[] = new Person("Peter",
    "Parker",
    "25 Ave",
    "98765",
    "New York",
    "project manager",
    "Oscorp",
    "123456543",
    "peter.parker@gmail.com",
    "https://github.com/peter-parker",
    true,
    "2001-10-07"
);

?>

<div class="card__container">
    <?php foreach ($persons as $person): ?>
        <div class="card">
            <div class="card__section">
                <div class="card__section__item card__section__item--name"><?= $person->getFullName() ?></div>
                <div class="card__section__item card__section__item--position"><?= $person->getPosition() ?></div>
                <div class="card__section__item card__section__item--company"><?= $person->getCompany() ?></div>
            </div>
            <div class="card__section">
                <div class="card__section__item card__section__item--age"><?= $person->getAge() ?> let</div>
                <div class="card__section__item card__section__item--phone"><?= $person->getPhone() ?></div>
                <div class="card__section__item card__section__item--address"><?= $person->getFullAddress() ?></div>
            </div>
            <div class="card__section card__section--link">
                <div class="card__section__item card__section__item--link">
                    <a href="mailto:<?= $person->getEmail() ?>"><?= $person->getEmail() ?></a>
                </div>
                <div class="card__section__item card__section__item--link">
                    <a href="<?= $person->getWeb() ?>"><?= $person->getWeb() ?></a>
                </div>
            </div>
            <div class="card__section">
                <div class="card__section__item card__section__item--status <?= $person->isOpenedToOffer() ? 'card__section__item--opened' : 'card__section__item--not-opened' ?>">
                    <?= $person->isOpenedToOffer() ? 'Opened for offers' : 'Currently not looking for a job' ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
