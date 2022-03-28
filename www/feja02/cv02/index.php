<?php
	class Person {
		public function __construct(
			$avatar,
			$firstName,
			$surName,
			$born,
			$title,
			$company,
			$street,
			$propertyNumber,
			$orientationNumber,
			$city,
			$phone,
			$email,
			$website,
			$available
		) {
			$this->avatar				= $avatar;
			$this->firstName			= $firstName;
			$this->surName				= $surName;
			$this->born					= $born;
			$this->title				= $title;
			$this->company				= $company;
			$this->street				= $street;
			$this->propertyNumber		= $propertyNumber;
			$this->orientationNumber	= $orientationNumber;
			$this->city					= $city;
			$this->phone				= $phone;
			$this->email				= $email;
			$this->website				= $website;
			$this->available			= $available;
		}

		public function getFullName() {
			return $this->firstName . ' ' . $this->surName;
		}

		public function getAddress() {
			return $this->street . ' ' . $this->propertyNumber . '/' . $this->orientationNumber . ', ' . $this->city;
		}

		public function getAge() {
			return getAgeFromDate($this->born);
		}
	}

	function getAgeFromDate($date) {
		$currentDate = date("d-m-Y");
		$age = date_diff(date_create($date), date_create($currentDate));
		return $age->format("%y");
	}

	$people = [];

	array_push($people, new Person(
		"./img/avatar1.jpg",
		"Bob",
		"Rob",
		"1-1-1992",
		"IT Support",
		"HellHole",
		"Nowhere Street",
		68,
		419,
		"Big City",
		"+420 777 777 777",
		"bob.rob@hellhole.com",
		"www.hellhole.com",
		false
	));

	array_push($people, new Person(
		"./img/avatar2.jpg",
		"Zack",
		"Dick",
		"7-6-1931",
		"Garbageman",
		"GarbageMasters",
		"Somewhere Street",
		98,
		776,
		"Small City",
		"+420 666 666 666",
		"zack.dick@garbagemasters.com",
		"www.garbagemasters.co.uk",
		false
	));

	array_push($people, new Person(
		"./img/avatar3.jpg",
		"Jerry",
		"Ken",
		"9-4-1999",
		"CEO",
		"ShadyCo",
		"Crime Street",
		4,
		229,
		"Weird City",
		"+420 666 999 222",
		"jerry.can@shadyco.com",
		"www.shadyco.org",
		false
	));

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="./css/main.css">
		<title>Business cards</title>
	</head>
	<body>
		<?php foreach($people as $person): ?>
		<div class="business-card">
			<div class="bc-avatar"><img src="<?php echo $person->avatar; ?>" width=100px alt="avatar"></div>
			<div class="bc-company"><?php echo $person->company; ?></div>
			<div class="bc-adress"><?php echo $person->getAddress(); ?></div>
			<div class="bc-name"><?php echo $person->getFullName(); ?></div>
			<div class="bc-title"><?php echo $person->title; ?></div>
			<div class="bc-phone"><a href="phone:<?php echo $person->phone; ?>"><?php echo $person->phone; ?></a></div>
			<div class="bc-mail"><a href="mail:<?php echo $person->email; ?>"> <?php echo $person->email; ?></a></div>
			<div class="bc-web"><a href="https://<?php echo $person->website; ?>"> <?php echo $person->website; ?></a></div>
			<div class="bc-offers"><?php echo $person->available ? 'Not available for contracts' : 'Now available for contracts'; ?></div>
		</div><br/>
		<?php endforeach; ?>
	</body>
</html>
