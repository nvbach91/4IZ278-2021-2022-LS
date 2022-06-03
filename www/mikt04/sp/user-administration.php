<?php include './include/head.php'; ?>
<?php include './include/nav.php'; ?>

<?php 
require_once './include/check-login.php';
require_once './include/clean-input.php';
require_once './database/UsersDB.php';

$messageSuccess = '';
$messageFail = '';
$valid = TRUE;

$usersDB = new UsersDB();
$user = $usersDB->fetchById($userId);

if (!empty($_POST)) {
    $passwordMain = cleanInput($_POST['password-main']);
    $passwordCheck = cleanInput($_POST['password-check']);

    if (isset($_POST['confirmation'])){
        $confirmation = $_POST['confirmation'];
    } else {
        $confirmation = 0;
    }

    if (strlen($passwordMain) < 4 || strlen($passwordCheck) < 4 ) {
        $messageFail = 'Heslo musí být alespoň 3 znaky dlouhé';
        $valid = FALSE;
    }

    if($confirmation != 1) {
        $messageFail = 'Vyžadováno potvrzení';
        $valid = FALSE;
    }

    if ($passwordMain != $passwordCheck){
        $messageFail = 'Zadaná hesla se neshodují';
        $valid = FALSE;
    }

    if($valid) {
        $hashedPassword = password_hash($passwordMain, PASSWORD_DEFAULT);
        $updated = $usersDB->updatePassword($userId, $hashedPassword);
        header('Location: signin.php');
        exit();
    }
}
?>

<main>
  <div class="wrapper">
  <?php include './include/message.php'?>
  <div class="user-container">
    <h1 class="page-title">Správa účtu</h1>
    <h2> Uživatel:</h2>
    <p><?php echo $user['first_name'] . ' ' . $user['last_name']?></p>
    <h2> Email:</h2>
    <p><?php echo $user['email']?></p>
  </div>
    <?php include './include/message.php'?>
        <div class="signup event-admin-create">
            <form class="form-template form-create-event" method="POST">
                <h2>Změnit heslo</h2>
                <div class="form-label-group">
                    <!--label for="password">Heslo</label-->
                    <input type="password" name="password-main" class="form-control" placeholder="Nové heslo" required>
                </div>
                <div class="form-label-group">
                    <!--label for="password">Heslo</label-->
                    <input type="password" name="password-check" class="form-control" placeholder="Potvrdit nové heslo" required>
                </div>
                <input type="checkbox" name="confirmation" class="checkbox-confirm" value="1">Nejsem robot</input>
                <br>
                <button class="button-2" type="submit">Aktualizovat</button>
            </form>
        </div>
  </div>
</main>

<?php include './include/foot.php'; ?>