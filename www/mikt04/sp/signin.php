<?php include './include/head.php'; ?>
<?php include './include/nav.php'; ?>
<?php require_once './database/UsersDB.php';?>
<?php require_once './include/check-logout.php';?>


<?php
    $messageSuccess = '';
    $messageFail = '';

    if (!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];

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
        }
    }
?>


<main>
    <div class="wrapper">
    <?php if(strlen(trim($messageSuccess)) > 0) { echo '<p class="fail">' . $messageSuccess . '</p>';}?>
    <?php if(strlen(trim($messageFail)) > 0) { echo '<p class="fail">' . $messageFail . '</p>';}?>
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
                <p>Nemáš účet? <a href="signup.php" class="notify">Zaregistruj se!</a></p>
            </form>
        </div>
    </div>
</main>


<?php include './include/foot.php'; ?>