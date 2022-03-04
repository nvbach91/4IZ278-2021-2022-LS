<?php

class Person{
    
    private $logoURL;
    private $firstName;
    private $lastName;
    private $born;
    private $position;
    private $corporation;
    private $street;
    private $streetNumber;
    private $streetNumberOrient;
    private $city;
    private $phone; 
    private $email;
    private $website;
    private $available;
    
    public function __construct(
        $logoURL,
        $firstName,
        $lastName,
        $born,
        $position,
        $corporation,
        $street,
        $streetNumber,
        $streetNumberOrient,
        $city,
        $phone, 
        $email,
        $website,
        $available
        ){
            $this->logoURL=$logoURL;
            $this->firstName=$firstName;
            $this->lastName=$lastName;
            $this->born=$born;
            $this->position=$position;
            $this->corporation=$corporation;
            $this->street=$street;
            $this->streetNumber=$streetNumber;
            $this->streetNumberOrient=$streetNumberOrient;
            $this->city=$city;
            $this->phone=$phone;
            $this->email=$email;
            $this->website=$website;
            $this->available=$available;
    }

    public function getLogoURL(){
        return $this->logoURL;
    }
        
    public function getFirstName(){
        return $this->firstName;
    }
    
    public function getLastName(){
        return $this->lastName;
    }

    public function getFullName(){
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getAge(){
        return getAgeFromBirthdate($this->born);
    }

    public function getPosition(){
        return $this->position;
    }
    
    public function getCorporation(){
        return $this->corporation;
    }
    
    public function getStreet(){
        return $this->street;
    }

    public function getStreetNumber(){
        return $this->streetNumber;
    }

    public function getStreetNumberOrient(){
        return $this->streetNumberOrient;
    }

    public function getFullStreetAddress(){
        return $this->street . ' ' . $this->streetNumber . ' ' . $this->streetNumberOrient;
    }

    public function getCity(){
        return $this->city;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getWebsite(){
        return $this->website;
    }

    public function getAvailable(){
        return $this->available ? 'Open for new job offers!' : 'Not open for new job offers!'; 
    }    
       
}

function getAgeFromBirthdate ($year){
    $currentDate = date("d-m-Y");
    $age = date_diff(date_create($year), date_create($currentDate));
    return $age->format("%y");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css">
    <title>CV02</title>
    <link href="css/main.css" rel="stylesheet">
</head>
<body>

<?php 

    $people = [];

    array_push($people, new Person(
        './images/boomerlogo.jpg',
        'Boomer',
        'Boomerovski',
        '10-12-1970',
        'CEO of Boomers Inc.',
        'Boomers Inc.',
        'Long',
        '10/B',
        '80',
        'Boomtown',
        '+420 123 456 789',
        'bb@boomers.inc',
        'https://en.wikipedia.org/wiki/OK_boomer',
        true));

    array_push($people, new Person(
        './images/mike.jpg',
        'Mike',
        'Wazowski',
        '03-10-1980',
        'Support Technician',
        'Boomers Inc.',
        'Green',
        '1200',
        '5',
        'Greencity',
        '+420 222 333 124',
        'mike@boomers.inc',
        'https://pixar.fandom.com/wiki/Mike_Wazowski',
        false));

    array_push($people, new Person(
        './images/sulley.jpg',
        'James P.',
        'Sullivan',
        '22-03-1920',
        'Sales Officer',
        'Boomers Inc.',
        'Door Street',
        '12',
        '999',
        'Scarytown',
        '+421 123 777 823',
        'sulley@boomers.inc',
        'https://disney.fandom.com/wiki/James_P._Sullivan',
        true));
   
   ?>

<h1>This is our scary company</h1>

<?php foreach($people as $person): ?>
<div class="business-card">
    <div class="bc-logo"><img src="<?php echo $person->getLogoURL(); ?>"></div>
    <div class="bc-name"><?php echo $person->getFullName();?></div>
    <div class="bc-age"><?php  echo $person->getAge() . ' years old';?></div>
    <div class="bc-position"><?php echo $person->getPosition(); ?></div>
    <div class="bc-corporation"><?php echo $person->getCorporation(); ?></div>
    <div class="bc-street"><?php echo $person->getFullStreetAddress(); ?></div>
    <div class="bc-city"><?php echo $person->getCity(); ?></div>
    <div class="contact">
        <div class="bc-phone"><i class="fa-solid fa-phone"></i><a href="tel:<?php echo $person->getPhone(); ?>"><?php echo $person->getPhone(); ?></a></div>
        <div class="bc-email"><i class="fa-solid fa-at"></i><a href="mailto:<?php echo $person->getEmail(); ?>"><?php echo $person->getEmail(); ?></a></div>
    </div>
    <div class="bc-website"></i><a target="_blank" href="<?php echo $person->getWebsite(); ?>"><?php echo $person->getWebsite(); ?></a></div>
    <div class="bc-available"><?php echo $person->getAvailable();?></div>

</div>
<?php endforeach; ?>

</body>
</html>