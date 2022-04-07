<?php
    require("./utils/utils.php");
    $email = "";
    $password = "";
    $successMessage = "";

    if (!empty($_POST)) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $errorList = [];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errorList, "Invalid email address");
        }

        if (strlen($password) < 8) {
            array_push($errorList, "Invalid password");
        }
        
        if (empty($errorList)) {
            $auth = authenticate($email, $password);
            if (is_string($auth)) {
                array_push($errorList, $auth);
            }
            else {
                $successMessage = "Logged in successfully";
            }
        }
    }
    else {
        if(!empty($_GET)) {
            $email = $_GET["email"];
            $successMessage = "Registration successful";
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
    <title>Login</title>
</head>
<body>
    <div class="form">
        <div class="form-status" style="background-color: <?php echo empty($errorList) ? "rgb(102, 255, 72)" : "rgb(255, 55, 55)"; ?>">
            <ul>
                <?php
                    if (!empty($successMessage)) {
                        echo "<li>$successMessage</li>";
                    }
                    elseif (!empty($errorList)) {
                        foreach ($errorList as $error) {
                            echo "<li>$error</li>";
                        }
                    }
                ?>
            </ul>
        </div>
        <div class="form-input">
            <form action="login.php" method="POST">
                <div class="form-input-email">
                    <input value="<?php echo $email; ?>" name="email" type="text" placeholder="email address">
                </div>
                <div class="form-input-password">
                    <input value="<?php echo $password; ?>" name="password" type="password" placeholder="password">
                </div>
                <input type="submit" value="&#10004;">
            </form>
        </div>
    </div>
</body>
</html>