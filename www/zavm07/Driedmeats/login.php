
<?php include 'inc/header.php'; ?>


<h1 class="text-center text-black mt-5">Přihlášení</h1>
<div class="container w-25 w m-auto text-black">
    <h5 class="m-1"><?php if (!empty($_GET['reg'])){ echo "Registrace proběhla úspěšně, nyní se můžete přihlásit"; } ?></h5>
    <h6 class="m-1 text-danger"><?php if (!empty($_GET['err'])){ echo "Špatný email nebo heslo"; } ?></h6>
    <form method="post" action="ctrl/loginController">
        <div class="form-group m-1">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="me@example.com">
        </div>
        <div class="form-group m-1">
            <label for="password">Heslo</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="********">
        </div>
        <button type="submit" class="btn btn-primary bg-primary border-0 m-1 ">Přihlásit se</button>
    </form>
        <?php include 'Facebook/fb_login.php'?>
</div>


<?php  include 'inc/footer.php'?>
