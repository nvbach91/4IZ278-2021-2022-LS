<?php
$logo = 'logo.png';
$companyName = 'Company';
$name = 'First Last';
$age = 69;
$position = 'Water Dispenser';
$phone = '+420 123 456 789';
$email = 'mail@mai.com';
$website = 'https://www.aaaaaaa.com';
$street = 'Sesame Street';
$streetNumber = 123;
$city = 'Prague';
$available = TRUE;
$address = $city . ' ' . $street . ' ' . $streetNumber;


class Person
{
    public $logo;
    public $companyName;
    public $firstName;
    public $lastName;
    public $year;
    public $position;
    public $phone;
    public $email;
    public $website;
    public $street;
    public $streetNumber;
    public $city;
    public $available;

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
    public function getAge($year)
    {
        return date("Y") - $year;
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
    'Not available for contracts'
);
$array = array($person1, $person2);
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

        <?php //foreach ($array as $key => $value) :
            foreach ($array as $person) : ?>
            <div class="business-card">
                <td><?= $key; ?></td>
                <img class="bc-logo" src="./img/<?= $person.$logo; ?>"></img>
                <div class="bc-name"><?= $person.getFullName(); ?></div>
                <div class="bc-age"><?php echo date("Y") - $age; ?></div>
                <div class="bc-position"><?php echo $position; ?></div>
                <div class="bc-phone"><a href="tel: <?php echo $phone; ?>"><?php echo $phone; ?></a></div>
                <div class="bc-email"><a href="mailto: <?php echo $email; ?>"><?php echo $email; ?></a></div>
                <div class="bc-website"><a target="_blank" href="<?php echo $website; ?>"><?php echo $website; ?></a></div>
                <div class="bc-address"><?php echo $address; ?></div>
                <div class="bc-status"><?php echo $available; ?></div>
            </div>
        <?php endforeach; ?>
        <div class="business-card">
            <img class="bc-logo" src="./img/<?php echo $logo; ?>"></img>
            <div class="bc-name"><?php echo $name; ?></div>
            <div class="bc-age"><?php echo date("Y") - $age; ?></div>
            <div class="bc-position"><?php echo $position; ?></div>
            <div class="bc-phone"><a href="tel: <?php echo $phone; ?>"><?php echo $phone; ?></a></div>
            <div class="bc-email"><a href="mailto: <?php echo $email; ?>"><?php echo $email; ?></a></div>
            <div class="bc-website"><a target="_blank" href="<?php echo $website; ?>"><?php echo $website; ?></a></div>
            <div class="bc-address"><?php echo $address; ?></div>
            <div class="bc-status"><?php echo $available; ?></div>
        </div>
    </main>
</body>

</html>