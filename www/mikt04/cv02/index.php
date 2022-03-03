<?php    
    class Person {
        public function __construct($avatar, $firstName, $lastName, $birthdate, $position, $company, $street, $streetcode, $postalcode, $city, $phone, $mail, $web, $status) {
            $this->avatar = $avatar;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->birthdate = $birthdate;
            $this->position = $position;
            $this->company = $company;
            $this->street = $street;
            $this->streetcode = $streetcode;
            $this->postalcode = $postalcode;
            $this->city = $city;
            $this->phone = $phone;
            $this->mail = $mail;
            $this->web= $web;
            $this->status = $status;
        }
        
        public function getAddress() {
            return "$this->street $this->streetcode / $this->postalcode, $this->city";
        }
    
        public function getFullName() {
            return "$this->firstName $this->lastName";
        }

        public function getAge() {
            $age = $this->age($this->birthdate);
            return $age;
        }
        
        private function age($birth) {
            $result = 2022 - $birth['year'];
            return $result;
        }
    }


    $tom = new Person(
    'https://media-exp1.licdn.com/dms/image/C5603AQE_bTjFpbHZ4g/profile-displayphoto-shrink_200_200/0/1583752753391?e=1648080000&v=beta&t=StRhoCF_XJLJl0Gyut0sEtqHhDR3A7TDXBuPd18kE8w',
    'Mikulenka',
    'Tomáš',
    [
        'day' => 10,
        'month' => 3,
        'year' => 2000,
    ],
    'Student',
    'University of economics Prague',
    'nám. Winstona Churchilla',
    '1938/4',
    13067,
    'Praha 3-Žižkov',
    '224 095 111',
    'mikt04@vse.cz',
    'eso.vse.cz/~mikt04',
    'open for jobs'
    );

    $tarantino = new Person(
        'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Quentin_Tarantino_by_Gage_Skidmore.jpg/225px-Quentin_Tarantino_by_Gage_Skidmore.jpg',
        'Tarantino',
        'Quentin',
        [
            'day' => 27,
            'month' => 3,
            'year' => 1963,
        ],
        'Director',
        'S Studio Dr',
        'Lake Buena Vista',
        '351',
        32830,
        'Los Angels',
        '224 095 111',
        'quentin@tarantino.ca',
        'https://www.tarantino.info/',
        'closed for jobs'
        );

        $weeknd = new Person(
            'https://www.theweeknd.com/sites/g/files/aaj14496/f/styles/suzuki_breakpoints_image_tablet/public/photo/202110/07/SPOTIFY%20-%20BRIANZIFF_THEWEEKND_1063%20%281%29.jpeg?itok=HbDRCkDz',
            '',
            'The Weeknd',
            [
                'day' => 16,
                'month' => 2,
                'year' => 1990,
            ],
            'Singer',
            'Beverly West',
            'Club View Drive',
            '1200',
            90024,
            'Los Angels',
            '224 095 111',
            'info@theweeknd.com',
            'https://www.theweeknd.com/',
            'closed for jobs'
            );
    
    $persons = [$tom, $tarantino, $weeknd];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./main.css">
    <title>Business card</title>
</head>
<body>
    <h1>These are my business cards</h1>
    <?php foreach($persons as $person): ?>
    <div class="business-card">
        <div class="bc-avatar"><img class="bc-avatar-image" src="<?php echo $person->avatar; ?>" alt="avatar"></div>
        <div class="bc-name"><?php echo $person->getFullName(); ?></div>
        <div class="bc-age"><?php echo 'age: '. $person->getAge(); ?></div>
        <div class="bc-position"><?php echo 'position: '. $person->position; ?></div>
        <div class="bc-company-name"><?php echo 'company name: '. $person->company; ?></div>
        <div class="bc-adress"><?php echo 'adress: '. $person->getAddress(); ?></div>
        <div class="bc-city"><?php echo 'city: '. $person->city; ?></div>
        <div class="bc-phone">
            <a href="phone:" <?php echo $person->phone; ?>><?php echo $person->phone; ?></a></div>
        <div class="bc-mail">
            <a href="mail: <?php echo $person->mail; ?>"> <?php echo $person->mail; ?></a></div>
        <div class="bc-web">
            <a href="web:" <?php echo $person->web; ?> > <?php echo $person->web; ?></a></div>
        <div class="bc-jobstatus"><?php echo 'job status: '. $person->status; ?></div>
    </div>
    <?php endforeach; ?>
</body>
</html>