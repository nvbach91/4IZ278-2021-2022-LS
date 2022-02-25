<?php
	
	$name = 'Jan Veverka';
	$position = 'Developer';
	$phone = '111111111';
	$email = 'vevj00@vse.cz';
	$website = 'www.moje.cz';
	
?>
<!DOCTYPE html>
<head>
<link href="./main.css" rel ="stylesheet">
</head>
<body>
<div class = "my-card">
	<div class = "bc-name"> <?php echo $name;?></div>
	<div class = "bc-position"><?php echo $position;?></div>
	<a class = "bc-phone" href="111111111"><?php echo $phone;?></a>
	<div>
	<a class = "bc-email" href="vevj00@vse.cz"><?php echo $email;?></a>
	<div>
	<a class = "bc-website" href="www.moje.cz"><?php echo $website;?></a>
</div>
</body>

</html>
