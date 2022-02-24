<?php

$image = "oof.jpeg";
$name  = "Václav Maroušek";
$age   = floor((time() - strtotime('23-07-2002')) / 31536000);
$pos   = "Programátor";
$job   = "NETTO Electronics";
$strt  = "Pěkná 420/69";
$city  = "Praha 7, Hlavní město Praha";
$phone = "+420 723 893 404";
$email = "marv22@vse.cz";
$web   = "github.com/VaanaCZ";
$avail = true;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vizitka</title>
	<style>
		#content
		{
			margin: 0 auto;
			width: 600px;
		}
			
		.card
		{
			box-shadow: 5px 10px #888888;
			background-color: rgba(255,0,0,0.2);
			display: block;
			padding: 64px;
			font-size: 18px;
		}
		
		.card-left
		{
			width: 55%;
			display: inline-block;
			vertical-align: top;
		}
		
		.card-right
		{
			width: 45%;
			display: inline-block;
			vertical-align: top;
		}
		
		.image {
			display: block;
			width: 60%;
			margin-bottom: 50px;
		}
		
		.name
		{
			font-weight: bold;
		}
		
		.age
		{
			margin-bottom: 20px;
		}
		
		.pos
		{
			font-style: italic;
			margin-bottom: 20px;
		}
		
		.phone
		{
			margin-bottom: 20px;
		}
		
		.city
		{
			margin-bottom: 20px;
		}
		
		.avail
		{
			font-style: italic;
		}
				
	</style>
  </head>
  <body>
	<div id="content">
		<h1>Byzniskard</h1>
		<div class="card">
			<div class="card-left">
				
				<img src="<?php echo $image; ?>" class="image">
				
				<div class="email"><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></div>
				<div class="web"><a href="https://<?php echo $web; ?>/"><?php echo $web; ?></a></div>
				
			</div><div class="card-right">
			
				<div class="name"><?php echo $name; ?></div>
				<div class="age"><?php echo $age; ?> let</div>
				
				<div class="job"><?php echo $job; ?></div>
				<div class="pos"><?php echo $pos; ?></div>
				
				<div class="phone"><a href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a></div>
				
				<div class="strt"><?php echo $strt; ?></div>
				<div class="city"><?php echo $city; ?></div>
				
				<div class="avail"><?php echo $avail ? "Dostupný" : "Nedostupný"; ?></div>
				
			</div>			
		</div>
	<div>
  </body>
</html>