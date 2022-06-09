<?php  include 'inc/header.php'; ?>
<?php include 'functions/userRequired.php' ?>


<?php
$errorMsg = [];
if(!empty($_SESSION['cui_errorMsg'])){
    $errorMsg = $_SESSION['cui_errorMsg'];
}

$usersDB = new UsersDB();
$user = $usersDB->fetchById($_SESSION['lg_email'])[0];

?>
<h1 class="text-center text-black mt-5">Informace o uživateli</h1>
<div class="container w-25 mx-auto text-black">
    <h5 class="m-1"><?php if (!empty($_GET['success'])){ echo "Vaše údaje  byly úspěšně změněny (celkem ".$_GET['success'].")"; } ?></h5>
    <?php foreach ($errorMsg as $msg): ?>
        <h6 class="m-1 text-danger"><?php echo $msg ?></h6>
    <?php endforeach; ?>
    <form method="post" action="ctrl/changeUserInfoController">
        <div class="form-group m-1">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="me@example.com" value="<?php echo $user['email'] ?>">
        </div>
        <div class="form-group m-1">
            <label for="f_name">Jméno</label>
            <input type="text" class="form-control" name="f_name" id="f_name" aria-describedby="name" placeholder="Jan" value="<?php echo $user['f_name'] ?>">
        </div>
        <div class="form-group m-1">
            <label for="s_name">Příjmení</label>
            <input type="text" class="form-control" name="s_name" id="s_name" aria-describedby="name" placeholder="Novák" value="<?php echo $user['s_name'] ?>">
        </div>
        <div class="form-group m-1">
            <label for="phone">Telefon</label>
            <input type="tel" class="form-control" name="phone" id="phone" placeholder="+420123456789" value="<?php echo $user['phone'] ?>">
        </div>
        <button type="submit" class="btn btn-primary bg-primary border-0 m-1 ">Změnit údaje</button>
    </form>
</div>

<?php include "inc/footer.php";?>

<!-- Mark fields with invalid values -->

<?php if (!empty($_SESSION['cui_errorValues'])): ?>
    <?php foreach ($_SESSION['cui_errorValues'] as $errorValue): ?>
        <script>$('#<?php echo $errorValue?>').css("border-color","red")</script>
    <?php endforeach;?>
<?php endif;?>

<!-- Empty temporary $_SESSION fields -->

<?php
$_SESSION['cui_errorValues'] = [];
$_SESSION['cui_errorMsg'] = []
?>


