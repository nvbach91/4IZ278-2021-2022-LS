<?php

class Person
{
    /*
    private $img;
    private $name;
    private $secondName;
    private $dateOfBirth;
    private $position;
    private $company;
    private $street;
    private $streetNo;
    private $streetNo2;
    private $city;
    private $phone;
    private $email;
    private $website;
    private $availaility;
    */

    function __construct($img, $name, $secondName, $dateOfBirth, $position, $company, $street, $streetNo, $streetNo2, $city, $phone, $email, $website, $availaility)
    {
        $this->img = $img;
        $this->name = $name;
        $this->secondName = $secondName;
        $this->dateOfBirth = $dateOfBirth;
        $this->position = $position;
        $this->company = $company;
        $this->street = $street;
        $this->streetNo = $streetNo;
        $this->streetNo2 = $streetNo2;
        $this->city = $city;
        $this->phone = $phone;
        $this->email = $email;
        $this->website = $website;
        $this->availaility = $availaility;
    }

    public function getFullName()
    {
        return "$this->name $this->secondName";
    }

    public function getAge()
    {
        $age = date_diff(date_create($this->dateOfBirth), date_create(date("d-m-Y")));
        return $age->format('%y');
    }

    public function getPosition()
    {
        return "$this->position in $this->company";
    }

    public function getAddress()
    {
        return "$this->street $this->streetNo, $this->streetNo2, $this->city";
    }

    public function getAvailability()
    {
        if ($this->availaility === 'available') {
            echo 'Currently available for job offers';
        } else {
            echo 'Currently unavailable for job offers';
        }
    }
}

$persons = [];

array_push($persons, new Person(
    './img1.png',
    'Homer',
    'Simpson',
    '12-5-1956',
    'Manager',
    'Springfield Nuclear Powerplant',
    'Main Street',
    '12',
    '38312',
    'Springfield',
    '555-7334',
    'homer@simpson.com',
    'www.springfieldnuclear.com',
    'unavailable'
));

array_push($persons, new Person(
    './img2.png',
    'Marge',
    'Simpson',
    '19-3-1969',
    'Housewife',
    'Simpsons household',
    'Evergreen Terrace',
    '742',
    '38312',
    'Springfield',
    '555-0113',
    'marge@gmail.com',
    'www.springfieldnuclear.com',
    'available'
));

array_push($persons, new Person(
    './img3.png',
    'Lisa',
    'Simpson',
    '9-5-1981',
    'President',
    'United States government',
    'Pennsylvania Avenue NW',
    '1600',
    '20500',
    'Washington D.C.',
    'CLASSIFIED',
    'CLASSIFIED',
    'www.whitehouse.gov',
    'unavailable'
));

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple business cards</title>
    <link href="./main.css" rel="stylesheet">
</head>

<body>
    <h1>DU02 - multiple business cards</h1>

    <div>
    <?php foreach ($persons as $person) : ?>
        <div class="business-card">
            
                <div class="left">
                    <div class="bc-img"><img src="<?php echo $person->img ?>" alt="x"></div>
                </div>
                <div class="right">
                    <div class="bc-name">
                        <?php echo $person->getFullName(); ?>
                    </div>
                    <div class="bc-age">
                        <?php echo $person->getAge(); ?>
                    </div>
                    <div class="bc-position">
                        <?php echo $person->getPosition(); ?>
                    </div>
                    <div class="bc-address">
                        <?php echo $person->getAddress(); ?>
                    </div>
                    <div class="bc-phone">
                        <?php echo $person->phone; ?>
                    </div>
                    <div class="bc-email">
                        <?php echo $person->email; ?>
                    </div>
                    <div class="bc-website">
                        <?php echo $person->website; ?>
                    </div>
                    <div class="bc-availability">
                        <?php echo $person->getAvailability() ?>
                    </div>
                </div>
        </div>
        <?php endforeach ?>
    </div>


</body>

</html>