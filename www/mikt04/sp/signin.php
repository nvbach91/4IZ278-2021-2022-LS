<?php
require_once './database/UsersDB.php';

    if (session_status() !== PHP_SESSION_ACTIVE) session_start();

    $information = '';

    if (!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $usersDB = new UsersDB();
        $userPassword = $usersDB->fetchPassword($email);

        if (password_verify($password, $userPassword)) {
            $_SESSION['id'] = $existingUser['user_id'];
            $_SESSION['email'] = $existingUser['email'];
            setcookie('email', $email, time() + 3600);
            header("Location: index.php");
            exit();
        }
        else {
            $information = "Špatný email nebo heslo";
        }
    }
?>


<?php include './include/head.php'; ?>
<?php include './include/nav.php'; ?>

<main>
    <div class="wrapper">
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
                <p class="warning"><?php echo $information?></p>
                <p>Nemáš účet? <a href="signup.php" class="notify">Zaregistruj se!</a></p>
            </form>
        </div>
    </div>
</main>


<?php include './include/foot.php'; ?>