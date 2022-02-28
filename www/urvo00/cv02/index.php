<?php
class Person
{
    private $logo;
    private $companyName;
    private $firstName;
    private $lastName;
    private $year;
    private $position;
    private $phone;
    private $email;
    private $website;
    private $street;
    private $streetNumber;
    private $city;
    private $available;

    public function getLogo()
    {
        return $this->logo;
    }
    public function getCompanyName()
    {
        return $this->companyName;
    }
    public function getPosition()
    {
        return $this->position;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getWebsite()
    {
        return $this->website;
    }
    public function getAvailable()
    {
        return $this->available;
    }

    public function __construct(
        $logo,
        $companyName,
        $firstName,
        $lastName,
        $year,
        $position,
        $phone,
        $email,
        $website,
        $street,
        $streetNumber,
        $city,
        $available
    ) {
        $this->logo = $logo;
        $this->companyName = $companyName;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->year = $year;
        $this->position = $position;
        $this->phone = $phone;
        $this->email = $email;
        $this->website = $website;
        $this->street = $street;
        $this->streetNumber = $streetNumber;
        $this->city = $city;
        $this->available = $available;
    }
    /**
     * 
     */
    public function getAddress()
    {
        return $this->city . ' ' . $this->street . ' ' . $this->streetNumber;
    }
    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
    public function getAge()
    {
        return date("Y") - $this->year;
    }
}

$person1 = new Person(
    'logo.png',
    'company1',
    'firstName1',
    'lastName1',
    1969,
    'positon1',
    '+420 123 456 789',
    'mail1@mail.com',
    'https://www.aaaaaaa.com',
    'Sesame Street',
    420,
    'City1',
    'Available for contracts'
);

$person2 = new Person(
    'logo.png',
    'company2',
    'firstName2',
    'lastName2',
    2000,
    'positon2',
    '+420 987 654 321',
    'mail2@mail.com',
    'https://www.bbbbbbb.com',
    'Sesame Street',
    666,
    'City2',
    'Not available for contracts'
);

$person3 = new Person(
    'logo.png',
    'company3',
    'firstName3',
    'lastName3',
    1999,
    'positon3',
    '+420 333 3333 333',
    'mail3@mail.com',
    'https://www.cccccccccc.com',
    'Sesame Street',
    999,
    'City3',
    'Not available for contracts'
);
$array = array($person1, $person2, $person3);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Business Card</title>
</head>

<body>
    <main>
        <h1>This is my business card</h1>

        <?php foreach ($array as $person) : ?>
            <div class="business-card">
                <img class="bc-logo" src="./img/<?= $person -> getLogo() ?>"></img>
                <div class="bc-company"><?= $person -> getCompanyName(); ?></div>
                <div class="bc-name"><?= $person -> getFullName(); ?></div>
                <div class="bc-age"><?= $person -> getAge(); ?></div>
                <div class="bc-position"><?= $person -> getPosition(); ?></div>
                <div class="bc-phone"><a href="tel: <?= $person -> getPhone(); ?>"><?= $person -> getPhone(); ?></a></div>
                <div class="bc-email"><a href="mailto: <?= $person -> getEmail(); ?>"><?= $person -> getEmail(); ?></a></div>
                <div class="bc-website"><a target="_blank" href="<?= $person -> getWebsite(); ?>"><?= $person -> getWebsite(); ?></a></div>
                <div class="bc-address"><?= $person -> getAddress(); ?></div>
                <div class="bc-status"><?= $person -> getAvailable(); ?></div>
            </div>
        <?php endforeach; ?>
    </main>
</body>

</html>