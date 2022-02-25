<?php
require('./Person.php');
$people = [];
$logo = "https://cdn1.iconfinder.com/data/icons/data-science-1-1/512/20-512.png";
array_push($people, new Person($logo,
    "Josef",
    "Katič",
    "Software Engineer/Student",
    "24.11.2000",
    "Company",
    "Ústecká",
    "26",
    "860",
    "Děčín",
    "+420 123 123 123",
    "katj00@vse.cz",
    "katj00@company.com",
    "eso.vse.cz/~katj00/cv02",
    false),
    new Person($logo,
        "Karel",
        "Novák",
        "Student",
        "17.11.1989",
        "Student",
        "Pražska",
        "1",
        "123",
        "Praha",
        "+420 123 123 123",
        "karel.n@email.cz",
        "karel.n@company.com",
        "eso.vse.cz/~katj00/cv02",
        false),
    new Person($logo,
        "František",
        "Novák",
        "Student",
        "1.1.1993",
        "Student",
        "Pražska",
        "1",
        "123",
        "Praha",
        "+420 123 123 123",
        "franta.n@email.cz",
        "franta.n@company.com",
        "eso.vse.cz/~katj00/cv02",
        true));

?>

<?php
foreach ($people as $p):
    ?>
    <div class="business-card">
        <div class="business-card__side">
            <div class="business-card__wrapper">
                <div class="business-card__container">
                    <div class="business-card__logo">
                        <img src="<?php echo $logo ?>" alt="Logo">
                    </div>
                    <div class="business-card__name">
                        <?php echo $p->getName() ?>
                    </div>
                    <div class="business-card__position"><?php echo $p->position; ?></div>
                </div>
            </div>
        </div>
        <div class="business-card__side">
            <div class="business-card__wrapper">
                <div class="business-card__container">
                    <h2 class="business-card__name">
                        <?php echo $p->getName(); ?>
                    </h2>
                    <div class="business-card__info">
                        <div class="business-card__contact">
                            Firma: <?php echo $p->company ?>
                        </div>
                        <div class="business-card__contact">
                            Věk: <?php echo $p->getAge() ?>
                        </div>
                        <div class="business-card__contact">
                            Adresa: <?php echo $p->getAddress() ?>
                        </div>
                        <div class="business-card__contact">
                            Telefon: <?php echo $p->phone ?>
                        </div>
                        <div class="business-card__contact">
                            Email: <a href='<?php echo "mailto:{$p->email}" ?>'><?php echo $p->email ?></a>
                        </div>
                        <div class="business-card__contact">
                            Pracovní email: <a
                                    href='<?php echo "mailto:{$p->companyEmail}" ?>'><?php echo "{$p->companyEmail}" ?></a>
                        </div>
                        <div class="business-card__contact">
                            Web: <a href='<?php echo "{$p->website}" ?>'><?php echo "{$p->website}" ?></a>
                        </div>
                        <div class="business-card__contact">
                            <?php echo $p->applicable ? "Hledám práci" : "Práci momentálně nehledám" ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
