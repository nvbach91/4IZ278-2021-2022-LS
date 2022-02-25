<?php

$logo = "logo.png";
$name = "Sofie Shtol";
$vars = array("Servírka", "Google", "https://www.shts.cz", "shts00@vse.cz",
"https://www.shts.cz", "+420 666 888 999");
$address = array("Blahova", "654", "2", "Praha 3");
$birthDate = "16-06-1995";
$age = date_diff(date_create($birthDate), date_create(date("d-m-Y")));
$availability = FALSE;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>
<body>
    <h1>This is my business card</h1>
    <div class="business-card">
        <div class="bc-img"> <?php  echo "<img src='$logo' />"; ?></div>
        <div class="bc-block">
            <div class="bc-name"><?php  echo $name;  ?></div>
            <div class="bc-info">
                <?php  
                    echo $age->format('%y let') . '<br>';
                    foreach ($vars as $var) {
                        echo $var . '<br>';}
                    
                    foreach ($address as $i) {
                        echo $i . '  ';} 
                    echo '<br>';
                    if($availability == TRUE || is_null($availability)) {
                        echo "Hledám kšeft" . '<br>';    
                    } 
                    else {
                        echo "Nemám zájem o nabídky" . '<br>';
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>