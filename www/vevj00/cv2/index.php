
<?php
	include 'Person.php';
	$Me = new Person('Jan Veverka', '1997-09-11', 'Developer', '111111111', 'www.moje.cz');
	$Franta = new Person('Franta Vomáčka', '1994-02-15', 'Data analyst', '111111112', 'www.franta.cz');
	$Pepa = new Person('Pepa Novák', '1990-02-15', 'Data analyst', '1110111112', 'www.pepik.cz');
	$persons = [$Me,$Franta,$Pepa];

	
?>
<!DOCTYPE html>
<head>
<link href="./main.css" rel ="stylesheet">
</head>
<body>
<div class = "cards">
<?php foreach ($persons as $person) : ?> 
<div class = "my-card">
	<div class = "bc-name"> <?php echo $person->getName();?></div>
	<div class = "bc-position"><?php echo $person->getPosision();?></div>
	<div class = "bc-age"><?php echo $person->getAge();?></div>
	<div class = "bc-phone"><?php echo $person->getContact();?></div>
	<div class = "bc-website"><?php echo $person->getWebAddress();?></div>
</div>
<?php endforeach ?>
</div>
</body>

</html>
