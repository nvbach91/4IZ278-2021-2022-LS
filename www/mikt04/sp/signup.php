<?php
session_start();

require './database/UsersDB.php';

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

    // dalsi moznosti je vynutit bcrypt: PASSWORD_BCRYPT
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if($validatedEmail){
        echo "true";
        echo "this email is in use";
    }
    if(!$validatedEmail){
        echo "false";
        $inserted = $usersDB->insertUser($firstName, $lastName, $email, $hashedPassword);
        header('Location: signin.php');
        exit();
    }

}
?>

<?php include './include/head.php'; ?>
<?php include './include/nav.php'; ?>

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