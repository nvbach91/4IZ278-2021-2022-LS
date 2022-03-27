<?php
	$avatar = "./img/avatar.jpg";
	$firstName = "Bob";
	$surName = "Rob";
	$born = "1-1-1992";
	$title = "IT Support";
	$company = "HellHole Inc.";
	$street = "Nowhere Street";
	$propertyNumber = 68;
	$orientationNumber = 419;
	$city = 'Big City';
	$phone = "+420 777 777 777";
	$email = "bob.rob@hellhole.com";
	$website = 'www.hellhole.com';
	$available = false;

	$today = date("d-m-Y");
	$diff = date_diff(date_create($today), date_create($born));
	$age = $diff->format("%y");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="./css/main.css">
		<title>Business card</title>
	</head>
	<body>
		<h1>This is my business card</h1>
		<div class="business-card">
			<div class="bc-avatar"><img src="<?php echo $avatar; ?>" width=100px alt="avatar"></div>
			<div class="bc-company"><?php echo $company; ?></div>
			<div class="bc-adress"><?php echo $street, ' '. $propertyNumber. "/" . $orientationNumber, ", " . $city; ?></div>
			<div class="bc-name"><?php echo $firstName . " " . $surName; ?></div>
			<div class="bc-title"><?php echo $title; ?></div>
			<div class="bc-phone"><a href="phone:<?php echo $phone; ?>"><?php echo $phone; ?></a></div>
			<div class="bc-mail"><a href="mail:<?php echo $email; ?>"> <?php echo $email; ?></a></div>
			<div class="bc-web"><a href="<?php echo $website; ?>"> <?php echo $website; ?></a></div>
			<div class="bc-offers"><?php echo $available ? 'Not available for contracts' : 'Now available for contracts'; ?></div>
		</div>
	</body>
</html>
