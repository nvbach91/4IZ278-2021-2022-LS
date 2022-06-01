<?php  include 'inc/header.php'; ?>

<?php
$errorMsg = [];
if(!empty($_SESSION['su_errorMsg'])){
    $errorMsg = $_SESSION['su_errorMsg'];
}
?>
<h1 class="text-center text-black mt-5">Registrace</h1>
<div class="container w-25 mx-auto text-black">
    <?php foreach ($errorMsg as $msg): ?>
    <h6 class="m-1 text-danger"><?php echo $msg ?></h6>
    <?php endforeach; ?>
    <form method="post" action="ctrl/singupController">
        <div class="form-group m-1">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="me@example.com">
        </div>
        <div class="form-group m-1">
            <label for="f_name">Jméno</label>
            <input type="text" class="form-control" name="f_name" id="f_name" aria-describedby="name" placeholder="Jan">
        </div>
        <div class="form-group m-1">
            <label for="s_name">Příjmení</label>
            <input type="text" class="form-control" name="s_name" id="s_name" aria-describedby="name" placeholder="Novák">
        </div>
        <div class="form-group m-1">
            <label for="phone">Telefon</label>
            <input type="tel" class="form-control" name="phone" id="phone" placeholder="+420123456789">
        </div>
        <div class="form-group m-1">
            <label for="password">Heslo</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="********">
        </div>
        <div class="form-group m-1">
            <label for="password2">Heslo znovu</label>
            <input type="password" class="form-control" name="password2" id="password2" placeholder="********">
        </div>
        <button type="submit" class="btn btn-primary bg-primary border-0 m-1 ">Zaregistrovat se</button>
    </form>
</div>

<?php include "inc/footer.php";?>

<!-- Add previously entered values -->

<?php if (!empty($_SESSION['su_errorMsg'])): ?>
<script>$("#email").val('<?php echo $_SESSION['su_values']['email'] ?>')</script>
<script>$("#f_name").val('<?php echo $_SESSION['su_values']['f_name'] ?>')</script>
<script>$("#s_name").val('<?php echo $_SESSION['su_values']['s_name'] ?>')</script>
<script>$("#phone").val('<?php echo $_SESSION['su_values']['phone'] ?>')</script>
<?php endif;?>

<!-- Mark fields with invalid values -->

<?php if (!empty($_SESSION['su_errorValues'])): ?>
    <?php foreach ($_SESSION['su_errorValues'] as $errorValue): ?>
        <script>$('#<?php echo $errorValue?>').css("border-color","red")</script>
    <?php endforeach;?>
<?php endif;?>

<!-- Empty temporary $_SESSION fields -->

<?php
$_SESSION['su_values']=[];
$_SESSION['su_errorMsg']=[];
$_SESSION['su_errorValues']=[];
?>


