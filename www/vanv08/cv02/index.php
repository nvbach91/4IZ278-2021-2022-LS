<?php
$myHommies = [];
class Person {
    /* 
    private $firstname;
    private $lastname;
    private $position;
    private $phone;
    private $email;
    private $website;
    private $company;
    private $street;
    private $streetNumber;
    private $orientNumber;
    private $city;
    private $available;
    private $bday;
    private $photo;
    */

function __construct($firstname, $lastname, $position, $phone, $email, $website, $company, $street, $streetNumber, $orientNumber, $city, $available, $bday, $photo)
{
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->position = $position;
    $this->phone = $phone;
    $this->email = $email;
    $this->website = $website;
    $this->company = $company;
    $this->street = $street;
    $this->streetNumber = $streetNumber;
    $this->orientNumber = $orientNumber;
    $this->city = $city;
    $this->available = $available;
    $this->bday = $bday;
    $this->photo = $photo;

}
public function getFullName() {
    return "$this->firstname $this->lastname";
}

public function getFullAdress(){
    return "$this->street $this->streetNumber/$this->orientNumber, $this->city";
}

public function calcAge(){
    $age = date_diff(date_create($this->bday), date_create(date('d-m-Y')));
        return $age->format('%y');
}
}
$myHomies = [];

array_push($myHomies, new Person(
    'Johnny',
    'Nguyen',
    'Barber','111222333','johnny.nguyen@suxeeded.com','johnnynuyen.org','Johnny inc.','Oxford',22,33,'Prague','Avaible','20-10-1999','goat.jpeg',
));

array_push($myHomies, new Person(
    'Asterix','Nguyen','Chef','999222111','astronguyen@gmail.com','nguyenastro.com','Nguyen Gastro inc.','Kook',22,66,'Poop','Available','20-10-1998','panda.jpeg',
));
array_push($myHomies, new Person(
    'Obelix','Nguyen','Gamer', '444222111','gamer68@gaymr.com','gamernation.com','Gamer Nation Inc.', 'Good', 22,44,'Fook','available','20-10-1997','yoshi.png',
))




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Ondrej Musil">
    <title>HW02: business cards</title>
    <link href="./assets/styles/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon.png">
</head>

<body>
    <?php foreach ($myHomies as $homie) : ?>
    <div class="businnes-card">
        <div class="bc-image">
            <img src="./assets/img/<?php echo $homie->photo; ?>" alt="photo">
        </div>

        <div class="bc-name"><?php echo $homie->getFullName(); ?></div>
        <div class="bc-age"><?php echo $homie->calcAge() . ','; ?></div>
        <div class="bc-position"><?php echo $homie->position; ?></div>
        <div class="bc-company"><?php echo $homie->company; ?></div>
        <div class="bc-address"><?php echo $homie->getFullAdress(); ?></div>
        <div class="contact bc-phone"></i>
            &nbsp;<a href="tel:<?php echo $homie->phone; ?>"><?php echo $homie->phone; ?></a></div>
        <div class="contact bc-email">
            &nbsp;<a href="mailto:<?php echo $homie->email; ?>"><?php echo $homie->email; ?></a></div>
        <div class="contact bc-website">
            &nbsp;<a href="<?php echo $homie->website; ?>" target="_blank"><?php echo $homie->website; ?></a></div>
        <div class="bc-available"><?php echo $homie->available; ?></div>
    </div>
        <div class="divider"></div>
        <?php endforeach; ?>
</body>

</html>