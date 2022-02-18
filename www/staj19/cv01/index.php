<?php
$companyName = 'GreenThumb Fast Track';
$companyLogoSrc = 'logo.svg';
$companyLogoAlt = 'Company logo';
$firstName = 'Mr.';
$secondName = 'Delivery';
$fullName = $firstName . ' ' . $secondName;
$birthDate = '2001-01-10';
$age = floor((time() - strtotime($birthDate)) / 31556926);
$position = 'Delivery boy';
$street = 'Evergreen terrace';
$descNum = '57';
$orienNum = '6';
$addressStreet = $street . ' ' . $descNum . '/' . $orienNum;
$city = 'Westfield';
$zip = '05 198';
$addressCity = $zip . ', ' . $city;
$phone = '+420 913 942 941';
$email = 'mr.delivery@greenthumb.com';
$website = 'www.greenthumb.com';
$availableForContract = true;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Business card</title>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.0.0/css/all.css">
  <link rel="stylesheet" href="css/main.css">
</head>

<body>
  <h1>Business card - cv01</h1>
  <?php if ($availableForContract) : ?>
    <div class="bc">
      <div class="bc-heading">
        <img src="img/<?php echo $companyLogoSrc; ?>" alt="<?php echo $companyLogoAlt; ?>">
        <div>
          <h2><?php echo $fullName . ' (' . $age . ')'; ?></h2>
          <span><?php echo $position; ?></span>
        </div>
      </div>
      <i></i>
      <div>
        <div class="address">
          <i class="fa-solid fa-location-dot"></i>
          <div>
            <span><?php echo $addressStreet; ?></span>
            <span><?php echo $addressCity; ?></span>
          </div>
        </div>
        <div>
          <a href="tel:<?php echo $phone; ?>">
            <i class="fa-solid fa-phone"></i><?php echo $phone; ?>
          </a>
        </div>
        <div>
          <a href="mailto:<?php echo $email; ?>">
            <i class="fa-solid fa-envelope"></i><?php echo $email; ?>
          </a>
        </div>
        <div>
          <a href="https://<?php echo $website; ?>">
            <i class="fa-solid fa-globe"></i><?php echo $website; ?>
          </a>
        </div>
      </div>
      <p><?php echo $companyName; ?></p>
    </div>
  <?php else : ?>
    <p>Not available for contracts.</p>
  <?php endif ?>
</body>

</html>