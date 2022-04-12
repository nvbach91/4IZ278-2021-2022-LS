<?php

$pragueTime = new DateTime('', new DateTimeZone('Europe/Prague'));
$pragueTimeForm = date_format($pragueTime, 'H:i:s d.m.Y e');
$pragueDiff = $pragueTime->getOffset() / 3600 - $pragueTime->getOffset() / 3600;

$asmeraTime = new DateTime('', new DateTimeZone('Africa/Asmera'));
$asmeraTimeForm = date_format($asmeraTime, 'H:i:s d/m/Y e');
$asmeraDiff = $asmeraTime->getOffset() / 3600 - $pragueTime->getOffset() / 3600;

$newYorkTime = new DateTime('', new DateTimeZone('America/New_York'));
$newYorkTimeForm = date_format($newYorkTime, 'h:i:s A m/d/y e');
$newYorkDiff = $newYorkTime->getOffset() / 3600 - $pragueTime->getOffset() / 3600;

$canberraTime = new DateTime('', new DateTimeZone('Australia/Canberra'));
$canberraTimeForm = date_format($canberraTime, 'h:i:s A M d, Y e');
$canberraDiff = $canberraTime->getOffset() / 3600 - $pragueTime->getOffset() / 3600;

$bangkokTime = new DateTime('', new DateTimeZone('Asia/Bangkok'));
$bangkokTimeForm = date_format($bangkokTime, 'H:i:s Y-m-d e');
$bangkokDiff = $bangkokTime->getOffset() / 3600 - $pragueTime->getOffset() / 3600;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>World clock</title>
</head>

<body>
  <h1>World hours</h1>
  <div>
    <h2>Prague</h2>
    <p>
      Datetime: <?php echo $pragueTimeForm; ?>
    </p>
    <p>
      Prague difference: <?php echo $pragueDiff; ?> hours
    </p>
  </div>
  <div>
    <h2>Asmera</h2>
    <p>
      Datetime: <?php echo $asmeraTimeForm; ?>
    </p>
    <p>
      Prague difference: <?php echo $asmeraDiff; ?> hours
    </p>
  </div>
  <div>
    <h2>New York</h2>
    <p>
      Datetime: <?php echo $newYorkTimeForm; ?>
    </p>
    <p>
      Prague difference: <?php echo $newYorkDiff; ?> hours
    </p>
  </div>
  <div>
    <h2>Canberra</h2>
    <p>
      Datetime: <?php echo $canberraTimeForm; ?>
    </p>
    <p>
      Prague difference: <?php echo $canberraDiff; ?> hours
    </p>
  </div>
  <div>
    <h2>Bangkok</h2>
    <p>
      Datetime: <?php echo $bangkokTimeForm; ?>
    </p>
    <p>
      Prague difference: <?php echo $bangkokDiff; ?> hours
    </p>
  </div>
</body>

</html>