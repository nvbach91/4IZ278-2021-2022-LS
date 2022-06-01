<?php require 'inc/header.php' ?>
<?php require 'functions/userRequired.php' ?>

<?php
$alert ="";
if (!empty($_GET['err'])){

    if($_GET['err']== 1){
        $alert = "Zadané současné heslo není platné";
    }

    if($_GET['err']== 2){
        $alert = "Nové heslo musí obsahovat alespoň 8 znaků";
    }

    if($_GET['err']== 3){
        $alert = "Zadaná nová hesla se neshodují, zkuste to prosím znovu";
    }

    if($_GET['err']== 4){
        $alert = "Něco se pokazilo, zkuste to prosím znovu";
    }
}
?>
<h1 class="text-center text-black mt-5">Změna hesla</h1>
<div class="container w-25 mx-auto text-black">
    <h5 class="m-1"><?php if (!empty($_GET['success'])){ echo "Vaše heslo bylo změněno"; } ?></h5>
    <h6 class="m-1 text-danger"><?php echo $alert?></h6>
    <form method="post" action="ctrl/changePasswordController">
        <div class="form-group m-1">
            <label for="currentPassword">Současné heslo</label>
            <input type="password" class="form-control" name="currentPassword" id="currentPassword" placeholder="me@example.com">
        </div>
        <div class="form-group m-1">
            <label for="newPassword">Nové heslo</label>
            <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="********">
        </div>
        <div class="form-group m-1">
            <label for="newPassword2">Nové heslo znovu</label>
            <input type="password" class="form-control" name="newPassword2" id="newPassword2" placeholder="********">
        </div>
        <button type="submit" class="btn btn-primary bg-primary border-0 m-1 ">Změnit heslo</button>
    </form>
</div>
<?php require 'inc/footer.php' ?>
