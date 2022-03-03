<?php

class Person
{
    public $logo;
    public $firstName;
    public $lastName;
    public $position;
    public $birthDate;
    public $phone;
    public $email;
    public $company;
    public $street;
    public $orientationNumber;
    public $descriptiveNumber;
    public $city;
    public $website;
    public $available;

    public function __construct(
        string   $logo,
        string   $firstName,
        string   $lastName,
        string   $position,
        DateTime $birthDate,
        string   $phone,
        string   $email,
        string   $company,
        string   $street,
        string   $orientationNumber,
        string   $descriptiveNumber,
        string   $city,
        string   $website,
        bool     $available
    )
    {
        $this->logo = $logo;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->position = $position;
        $this->birthDate = $birthDate;
        $this->phone = $phone;
        $this->email = $email;
        $this->company = $company;
        $this->street = $street;
        $this->orientationNumber = $orientationNumber;
        $this->descriptiveNumber = $descriptiveNumber;
        $this->city = $city;
        $this->website = $website;
        $this->available = $available;
    }

    public function getAddress(): string
    {
        return sprintf('%s %s/%s, %s', $this->street, $this->descriptiveNumber, $this->orientationNumber, $this->city);
    }

    public function getFullName(): string
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
    }

    public function getAge(): int
    {
        return (new DateTime())->diff($this->birthDate)->y;
    }
}

$list = [];

$list[] = new Person(
    'https://assets.faceit-cdn.net/teams_avatars/70e2d286-0819-4182-ac0c-baa4a88b8e12_1608250117890.jpg',
    'Marko',
    'Vanhanen',
    'Professional cofe maker',
    new DateTime('1986-03-05'),
    '+3580400471747',
    'markovanhanen@luukku.com',
    'currently unemployed',
    'Keiteleentie',
    'B4',
    '2-4',
    'Suolahti',
    'https://www.youtube.com/channel/UCX1t6Vm0DsU95Q5JlsNM1vQ',
    true
);

$list[] = new Person(
    'https://autobible.euro.cz/wp-content/uploads/2021/02/P%C5%99ednost-protijedouc%C3%ADch-vozidel-p7.jpg',
    'Test',
    'Testič',
    'Tester',
    new DateTime('1966-12-31'),
    '+3322445566',
    'markovanhanen@luukku.com',
    'Test Inc.',
    'Testing',
    '34',
    '21',
    'Tested',
    'https://testing.com',
    false
);

$list[] = new Person(
    'https://cdn-icons-png.flaticon.com/512/1541/1541402.png',
    'Debug',
    'Debugger',
    'Bug finder',
    new DateTime('1956-02-03'),
    '+2114556776',
    'debuuger@bug.inc',
    'Bug Inc.',
    'Bugged',
    '33',
    '12',
    'Bugger',
    'https://debugger.com',
    true
);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>Businesscard</title>
</head>
<body>

<?php foreach ($list as $person) : ?>
<div class="bc">
    <img src="<?= $person->logo ?>" alt="Marko">
    <h1><?= $person->getFullName() ?></h1>
    <h2><?= $person->position ?>, <?= $person->company ?></h2>
    <h3><?= $person->getAge() ?> years old</h3>
    <ul>
        <li><?= $person->getAddress() ?></li>
        <li><a href="mailto:<?= $person->email ?>"><?= $person->email ?></a></li>
        <li><a href="tel:<?= $person->phone ?>"><?= $person->phone ?></a></li>
        <li><a href="<?= $person->website ?>">Web</a></li>
        <li><?php echo $person->available ? 'Available' : 'Not available' ?></li>
    </ul>
</div>
<?php endforeach; ?>
</body>
</html>


