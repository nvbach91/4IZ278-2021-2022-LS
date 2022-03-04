<?php

class Person
{
    function __construct($firstName, $lastName, $position, $phone, $email, $website, $companyName, $street, $buildingIdNum, $houseNum, $city, $img, $available, $birthDate)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->position = $position;
        $this->phone = $phone;
        $this->email = $email;
        $this->website = $website;
        $this->companyName = $companyName;
        $this->street = $street;
        $this->buildingIdNum = $buildingIdNum;
        $this->houseNum = $houseNum;
        $this->city = $city;
        $this->img = $img;
        $this->available = $available;
        $this->birthDate = $birthDate;
    }

    public function getFullName()
    {
        return "$this->firstName $this->lastName";
    }

    public function getAddress()
    {
        return "$this->street $this->buildingIdNum/$this->houseNum, $this->city";
    }

    public function isAvailable()
    {
        return $this->available ? 'Available for contracts' : 'Not available for contracts';
    }

    public function getAge()
    {
        $age = date_diff(date_create($this->birthDate), date_create(date('d-m-Y')));
        return $age->format('%y');
    }
}

$currentDate = date('d-m-Y');

$persons = [];


array_push($persons, new Person(
    'Marshall',
    'Mathers',
    'Rapper',
    '+313 313 313 313',
    'realslimshady@mathers.com',
    'https://momsspaghetti.com',
    'Marshall Records Inc.',
    'B-rabbit Av.',
    21222,
    87,
    'Chicago',
    'em.jpeg',
    false,
    '17-10-1972',
));

array_push($persons, new Person(
    'Will',
    'Smith',
    'Actor',
    '+407 123 456 789',
    'will@smith.com',
    'https://willsmith.com',
    'The Fresh Prince Records',
    'Carlton',
    100,
    2,
    'BellAir',
    'prince.jpeg',
    true,
    '25-09-1968',
));

array_push($persons, new Person(
    'Borat',
    'Sagdiyev',
    'Journalist',
    '+7 928 228 124',
    'borat@f-uzbekistan.com',
    'https://boratandazamat.com',
    'Kazachstan Press',
    'Emental',
    12,
    1,
    'Glod',
    'borat.jpeg',
    true,
    '13-10-1971',
));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ondrej Musil">
    <title>HW02: business card</title>
    <link href="./assets/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon.png">
</head>

<body>
    <header>
        <h1>These are my <span class="headline">business cards</span></h1>
    </header>
    <main>
        <?php foreach ($persons as $person) : ?>
            <div class="business-card">
                <div class="bc-image">
                    <img src="./assets/img/<?php echo $person->img; ?>" alt="photo">
                </div>
                <div class="bc-text-content">
                    <div class="bc-name"><?php echo $person->getFullName(); ?></div>
                    <div class="bc-age"><?php echo $person->getAge() . ','; ?></div>
                    <div class="bc-position"><?php echo $person->position; ?></div>
                    <div class="bc-company"><?php echo $person->companyName; ?></div>
                    <div class="bc-address"><?php echo $person->getAddress(); ?></div>
                    <div class="contact bc-phone"><i class="fa fa-phone"></i>
                        &nbsp;<a href="tel:<?php echo $person->phone; ?>"><?php echo $person->phone; ?></a></div>
                    <div class="contact bc-email"><i class="fa fa-envelope"></i>
                        &nbsp;<a href="mailto:<?php echo $person->email; ?>"><?php echo $person->email; ?></a></div>
                    <div class="contact bc-website"><i class="fa fa-globe"></i>
                        &nbsp;<a href="<?php echo $person->website; ?>" target="_blank"><?php echo $person->website; ?></a></div>
                    <div class="bc-available"><?php echo $person->isAvailable(); ?></div>
                </div>
            </div>
            <div class="clear"></div>
        <?php endforeach; ?>
    </main>
</body>

</html>