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


if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $firstName = cleanInput($_POST['first-name']);
    $lastName = cleanInput($_POST['last-name']);
    $email = cleanInput($_POST['email']);
    $password = cleanInput($_POST['password']);

    if (isset($_POST['confirmation'])){
        $confirmation = $_POST['confirmation'];
    } else {
        $confirmation = 0;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $messageFail = 'Neplatný email';
        $valid = FALSE;
    }

    if (strlen($password) < 4) {
        $messageFail = 'Heslo musí být alespoň 3 znaky dlouhé';
        $valid = FALSE;
    }

    if($confirmation != 1) {
        $messageFail = 'Vyžadováno potvrzení';
        $valid = FALSE;
    }

    $usersDB = new UsersDB();
    $validatedEmail = $usersDB->validateEmail($email);

    if($validatedEmail){
        $messageFail = 'Tento email se již používá';
        $valid = FALSE;
    }

    if($valid) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $normalPrivilage = 1;
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
    <?php include './include/message.php'?>
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
                <a class="button-2" href="<?php echo $fbLoginUrl;?>">Zaregistrovat se přes Facebook</a>
                <p>Máš účet? <a href="signin.php" class="notify">Přihlaš se!</a></p>
            </form>
        </div>
    </div>
</main>

<?php include './include/foot.php'; ?>