<?php


/*$avatar = 'https://media.vogue.fr/photos/5fbbdfd569406dbb7ff1ca7c/1:1/w_2537,h_2537,c_limit/010_A7A11280_145.jpg';
$name = 'Ryan Gosling';
$currentYear = '2022';
$birthYear = '1980';
$position = 'Actor';
$firm = 'Hollywood';
$adress = 'Los Angeles, California';
$phone = '+420 228 014 880';
$email = 'ryan.gosling@gmail.com';
$website = 'https://www.ryangosling.com';*/

function ageFunc($currentYear, $birthYear)
{
    $age = $currentYear - $birthYear;
    return $age;
}

class Person
{
    private $currentYear;
    private $birthYear;

    function __construct($avatar, $firstName, $lastName, $currentYear, $birthYear, $position, $firm, $adress, $phone, $email, $website)
    {
        $this->avatar = $avatar;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->currentYear = $currentYear;
        $this->birthYear = $birthYear;
        $this->position = $position;
        $this->firm = $firm;
        $this->adress = $adress;
        $this->phone = $phone;
        $this->email = $email;
        $this->website = $website;
    }

    public function getAge()
    {
        $age = ageFunc($this->currentYear, $this->birthYear);
        return $age;
    }

    public function getFullName()
    {
        return "$this->firstName $this->lastName";
    }
}

$persons = [];

array_push($persons, new Person(
    'https://media.vogue.fr/photos/5fbbdfd569406dbb7ff1ca7c/1:1/w_2537,h_2537,c_limit/010_A7A11280_145.jpg',
    'Ryan',
    'Gosling',
    2022,
    1980,
    'Actor',
    'Hollywood',
    'Los Angeles, California',
    '+420 228 014 880',
    'ryan.gosling@gmail.com',
    'https://www.ryangosling.com'

));

array_push($persons, new Person(
    'https://apa.az/storage/news/2021/september/03/big/6131f75cbbce26131f75cbbce316306645406131f75cbbce06131f75cbbce1.jpg',
    'Vladislav',
    'Pozdnyakov',
    2022,
    1991,
    'Doctor',
    'MG-Clinic',
    'Moscow, Russia',
    '+420 158 074 690',
    'gachislav.pozdnyakov@gmail.com',
    'https://www.mg-clinic.com'

));

array_push($persons, new Person(
    'https://upload.wikimedia.org/wikipedia/commons/7/77/Tessa_Violet_September_2018.png',
    'Tessa',
    'Violet',
    2022,
    1990,
    'Singer',
    'Maker Music',
    'Culver City, California',
    '+420 777 157 951',
    'tessa.violet@gmail.com',
    'https://www.tessa-violet.com'

));



?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="./css/style.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300&display=swap" rel="stylesheet" />
</head>

<body>
    <?php foreach ($persons as $person) : ?>
        <div class="business-card">
            <div class="bc-avatar"> <img src="<?php echo $person->avatar; ?>"></div>
            <div class="bc-content">
                <div class="bc-name"> <?php echo $person->getFullName(); ?></div>
                <div class="bc-age">
                    <p>age: <?php echo $person->getAge(); ?></p>
                </div>
                <div class="bc-firm">
                    <p>firm: <?php echo $person->firm; ?></p>
                </div>
                <div class="bc-position">
                    <p>position: <?php echo $person->position; ?></p>
                </div>
                <div class="bc-adress">
                    <p>adress: <?php echo $person->adress; ?></p>
                </div>
                <div class="bc-phone">
                    <a href="tel: <?php echo $person->phone; ?>"><?php echo $person->phone; ?></a>
                </div>
                <div class="bc-email">
                    <a href="mailto: <?php echo $person->email; ?>"><?php echo $person->email; ?></a>
                </div>
                <div class="bc-website">
                    <a target="link:" href="=<?php echo $person->website; ?>"><?php echo $person->website; ?></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</body>

</html>