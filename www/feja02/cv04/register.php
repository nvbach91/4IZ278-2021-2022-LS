<?php

require("./utils/utils.php");

$name = "";
$email = "";
$password = "";
$password_confirm = "";
$registered = false;

$errorList = [];

if (!empty($_POST)) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_confirm = $_POST["password_confirm"];

    //Database check

    if (fetchUser($email) !== NULL) {
        array_push($errorList, "A user with this email already exist");
    }

    if (strlen($name) < 6) {
        array_push($errorList, "Name must be at least 6 chars long");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errorList, "Invalid email address");
    }
    
    if (strlen($password) < 8) {
        array_push($errorList, "Password must be at least 8 chars long");
    }

    if ($password !== $password_confirm) {
        array_push($errorList, "Passwords do not match");
    }

    if (empty($errorList)) {
        registerNewUser($name, $email, $password);
        header("Location: login.php?email=$email");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/main.css">
    <title>Registration</title>
</head>
<body>
    <div class="form">
        <div class="form-status" style="background-color: rgb(255, 55, 55)">
            <ul>
                <?php
                    foreach ($errorList as $error) {
                        echo "<li>" . $error . "</li>";
                    }
                ?>
            </ul>
        </div>
        <div class="form-input">
            <form action="register.php" method="POST">
                <div class="form-input-name">
                    <input value="<?php echo $name; ?>" name="name" type="text" placeholder="full name">
                </div>
                <div class="form-input-email">
                    <input value="<?php echo $email; ?>" name="email" type="text" placeholder="email address">
                </div>
                <div class="form-input-password">
                    <input value="<?php echo $password; ?>" name="password" type="password" placeholder="password">
                </div>
                <div class="form-input-password">
                    <input value="<?php echo $password_confirm; ?>" name="password_confirm" type="password" placeholder="password again">
                </div>
                <input type="submit" value="&#10004;">
            </form>
        </div>
    </div>
</body>
</html>