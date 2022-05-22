<?php include './include/head.php'; ?>
<?php include './include/nav.php'; ?>
<?php require_once './database/UsersDB.php';?>
<?php require_once './include/check-logout.php';?>

<?php
if ('POST' == $_SERVER['REQUEST_METHOD']) {

    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmation = $_POST['confirmation'];
    $valid = TRUE;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo ('Invalid email');
        $valid = FALSE;
    }

    if (strlen($password) < 3) {
        echo ('Password must be at least 3 characters long');
        $valid = FALSE;
    }

    if ($confirmation != 1) {
        echo ('Vyžadováno potvrzení');
        $valid = FALSE;
    }

    $usersDB = new UsersDB();
    $validatedEmail = $usersDB->validateEmail($email);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $normalPrivilage = 1;

    if($validatedEmail){
        echo "this email is in use";
    }
    if(!$validatedEmail){
        date_default_timezone_set('Europe/Prague');
        $date = date('Y-m-d H:i:s', time());
        $inserted = $usersDB->insertUser($firstName, $lastName, $email, $hashedPassword, $date, $normalPrivilage);
        header('Location: signin.php');
        exit();
    }

}
?>

<main>
    <div class="wrapper">
        <div class="signup">
            <form class="form-template form-signup" method="POST">
                <h2>Registrace</h2>
                <div class="form-label-group">
                    <!--label for="email">Email</label-->
                    <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
                </div>
                <div class="form-label-group">
                    <!--label for="first-name">Jméno</label-->
                    <input type="first-name" name="first-name" class="form-control" placeholder="Jméno" required autofocus>
                </div>
                <div class="form-label-group">
                    <!--label for="last-name">Přijmení</label-->
                    <input type="last-name" name="last-name" class="form-control" placeholder="Příjmení" required autofocus>
                </div>
                <div class="form-label-group">
                    <!--label for="password">Heslo</label-->
                    <input type="password" name="password" class="form-control" placeholder="Heslo" required>
                </div>
                <input type="checkbox" name="confirmation" class="checkbox-confirm" value="1">Nejsem robot</input>
                <br>
                <button class="button-2" type="submit">Vytvořit účet</button>
                <p>Máš účet? <a href="signin.php" class="notify">Přihlaš se!</a></p>
            </form>
        </div>
    </div>
</main>

<?php include './include/foot.php'; ?>