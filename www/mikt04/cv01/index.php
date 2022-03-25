<?php
    $avatar = 'https://media-exp1.licdn.com/dms/image/C5603AQE_bTjFpbHZ4g/profile-displayphoto-shrink_200_200/0/1583752753391?e=1648080000&v=beta&t=StRhoCF_XJLJl0Gyut0sEtqHhDR3A7TDXBuPd18kE8w';
    $fullName = 'Tomáš Mikulenka';
    $surname = 'Mikulenka';
    $firstName = 'Tomáš';
    $age = 22;
    $position = 'Student';
    $companyName = 'University of economics Prague';
    $street = 'nám. Winstona Churchilla';
    $streetcode = '1938/4';
    $postalcode = '130 67';
    $city = 'Praha 3-Žižkov';
    $phone = '224 095 111';
    $mail = 'mikt04@vse.cz';
    $web = 'eso.vse.cz/~mikt04';
    $jobstatus = 'open for jobs';

    
    
    
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
    <h1>This is my business card</h1>
    <div class="business-card">
        <div class="bc-avatar"><img src="<?php echo $avatar; ?>" alt="avatar"></div>
        <div class="bc-name"><?php echo $fullName; ?></div>
        <div class="bc-age"><?php echo 'age: '. $age; ?></div>
        <div class="bc-position"><?php echo 'position: '. $position; ?></div>
        <div class="bc-company-name"><?php echo 'company name: '. $companyName; ?></div>
        <div class="bc-adress"><?php echo 'adress: '. $street, ', '. $streetcode, ', ' . $postalcode; ?></div>
        <div class="bc-city"><?php echo 'city: '. $city; ?></div>
        <div class="bc-phone">
            <a href="phone:" <?php echo $phone; ?>><?php echo $phone; ?></a></div>
        <div class="bc-mail">
            <a href="mail: <?php echo $mail; ?>"> <?php echo $mail; ?></a></div>
        <div class="bc-web">
            <a href="web:" <?php echo $web; ?> > <?php echo $web; ?></a></div>
        <div class="bc-jobstatus"><?php echo 'job status: '. $jobstatus; ?></div>
    </div>
</body>
</html>