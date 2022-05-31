<?php include './include/head.php'; ?>
<?php include './include/nav.php'; ?>
<?php require_once './database/UsersDB.php';?>
<?php require_once './include/check-logout.php';?>
<?php require_once './include/clean-input.php';?>
<?php require_once './facebook/facebook.php';?>


<?php
$messageSuccess = '';
$messageFail = '';
$valid = TRUE;

$fbHelper = $fb->getRedirectLoginHelper();
$permissions = ['email'];
$callbackUrl = htmlspecialchars('https://eso.vse.cz/~mikt04/webove-aplikace/sp/facebook/fb-callback.php');
$fbLoginUrl = $fbHelper->getLoginUrl($callbackUrl, $permissions);


if (!empty($_POST)) {
    $email = cleanInput($_POST['email']);
    $password = cleanInput($_POST['password']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $messageFail = 'Neplatný email';
        $valid = FALSE;
    }

    $usersDB = new UsersDB();
    $userPassword = $usersDB->fetchPassword($email);
    $user = $usersDB->fetchByEmail($email);

    if (password_verify($password, $userPassword)) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['privilege'] = $user['privilege'];
        setcookie('email', $email, time() + 3600);
        $messageSuccess = 'Úspěšně přihlášen';
        header("Location: index.php");
        exit();
    }
    else {
        $messageFail = "Špatný email nebo heslo";
        $valid = FALSE;
    }
}
?>


<main>
    <div class="wrapper">
    <?php include './include/message.php'?>
        <div class="signup">
            <form class="form-template form-signin" method="POST">
            <h2>Přihlášení</h2>
                <div class="form-label-group">
                    <!--label for="email">Email</label-->
                    <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
                </div>
                <div class="form-label-group">
                    <!--label for="password">Heslo</label-->
                    <input type="password" name="password" class="form-control" placeholder="Heslo" required>
                </div>
                <button type="submit" class="button-2">Potvrdit</button>
                <a class="button-2" href="<?php echo $fbLoginUrl;?>">Přihlásit se přes Facebook</a>
                <p>Nemáš účet? <a href="signup.php" class="notify">Zaregistruj se!</a></p>
            </form>
        </div>
    </div>
</main>


<?php include './include/foot.php'; ?>