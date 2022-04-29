<?php 
include 'header.php';
?>

<?php
class Person {

    function __construct(
        $logo, 
        $firstName, 
        $lastName, 
        $birthDate, 
        $position, 
        $company, 
        $website, 
        $email, 
        $phone, 
        $street, 
        $buildingNumber, 
        $buildingNumberOnStreet, 
        $city, 
        $availability
        ) 
    {
        $this->logo = $logo;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        $this->position = $position;
        $this->company = $company;
        $this->website = $website;
        $this->email = $email;
        $this->phone = $phone;
        $this->street = $street;
        $this->buildingNumber = $buildingNumber;
        $this->buildingNumberOnStreet = $buildingNumberOnStreet;
        $this->city = $city;
        $this->availability = $availability;
    }

    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getAddress()
    {
        return $this->street . ' ' . $this->buildingNumber . '/' . $this->buildingNumberOnStreet . ', ' . $this->city;
    }

    public function getAge()
    {
        return getAgeFromBirthDate($this->birthDate); 
    }

}

function getAgeFromBirthDate($birthDate) 
{
    $age = date_diff(date_create($birthDate), date_create(date("d-m-Y")));
    return $age->format("%y");
}

$peopleArr = [];

array_push($peopleArr, new Person(
    "./img/google-logo.png",
    "Sofie",
    "Shtol",
    "16-06-1995",
    "Servírka",
    "Google",
    "https://www.shts.cz",
    "shts00@vse.cz",
    "+420 666 888 999",
    "Blahova",
    "654",
    "2",
    "Praha 3",
    false
));

array_push($peopleArr, new Person(
    "./img/amazon-logo.jpg",
    "Robert",
    "Bay",
    "01-12-1996",
    "IT Consultant",
    "Amazon",
    "https://www.amazon.com",
    "rob@bay.com",
    "+1 666 444 123",
    "James Crush street",
    "6799",
    "2",
    "Los Angeles",
    true
));

array_push($peopleArr, new Person(
    "./img/sap-logo.png",
    "Claire",
    "Support",
    "09-10-1978",
    "Enterprise Architect",
    "SAP",
    "https://www.sap.com",
    "sap@sap.com",
    "+1 666 444 123",
    "James Crush street",
    "6799",
    "2",
    "Los Angeles",
    false
));
?>

<?php foreach($peopleArr as $person): ?>
<div class="business-card">
    <div class="bc-img"><img src="<?php echo $person->logo; ?>" alt="logo"></div>
    <div class="bc-block">
        <div class="bc-name"><?php echo $person->getFullName(); ?></div>
        <div class="bc-age"><?php echo $person->getAge() . " let"; ?></div>
        <div class="bc-position"><?php echo $person->position; ?></div>
        <div class="bc-company"><?php echo $person->company; ?></div>
        <div class="bc-website"><?php echo $person->website; ?></div>
        <div class="bc-email"><?php echo $person->email; ?></div>
        <div class="bc-phone"><?php echo $person->phone; ?></div>
        <div class="bc-address"><?php echo $person->phone; ?></div>
        <div class="bc-available"><?php echo $person->availability ? 'Hledám kšeft' : 'Nemám zájem o nabídky'; ?></div>
    </div>
</div>
<?php endforeach; ?>

<?php 
include 'footer.php';
?>