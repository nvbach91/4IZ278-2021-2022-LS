<?php
include "include/header.php";
require "functions/userCheck.php";

if($_SESSION["login_oauth"] == 1) {
    header("Location: ./");
    exit();
}
?>

<h1 class="text-center text-black mt-5">Account Settings</h1>
<div class="d-flex w-50 mx-auto text-black flex-column flex-wrap mt-4 mb-5">
    <div class="row justify-content-center text-center">
        <div class="col-md-5">
            <div class="card my-5">
                <form method="POST" action="./functions/accountChange">
                    <?php if (!empty($_GET["email"]) && $_GET["email"] == 1): ?>
                    <div class="m-3 alert alert-success text-center">
                        <h6>E-mail successfully changed!</h6>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($_GET["email"]) && $_GET["email"] > 1): ?>
                    <div class="m-3 alert alert-danger text-center">
                        <?php echo ($_GET["pass"] == 2 ? "Invalid e-mail" : "E-mail confirmation doesn't match"); ?>
                    </div>
                    <?php endif; ?>
                    <div class="form-text text-center m-4 text-dark">
                        <h6>Change E-mail Address</h6>
                    </div>
                    <div class="m-3">
                        <input class="form-control" name="email" type="text" placeholder="E-mail Address">
                    </div>
                    <div class="m-3">
                        <input class="form-control" name="emailConfirm" type="text" placeholder="E-mail Address Again">
                    </div>
                    <hr class="w-75 mx-auto">
                    <?php if (!empty($_GET["pass"]) && $_GET["pass"] == 1): ?>
                    <div class="m-3 alert alert-success text-center">
                        <h6>Password successfully changed!</h6>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($_GET["pass"]) && $_GET["pass"] > 1): ?>
                    <div class="m-3 alert alert-danger text-center">
                        <?php echo ($_GET["pass"] == 2 ? "Password too short (min. 8 characters)!" : "Password confirmation doesn't match"); ?>
                    </div>
                    <?php endif; ?>
                    <div class="">
                        <h6>Change Password</h6>
                    </div>
                    <div class="m-3">
                        <input class="form-control" name="password" type="password" placeholder="Password">
                    </div>
                    <div class="m-3">
                        <input class="form-control" name="passwordConfirm" type="password" placeholder="Password Again">
                    </div>
                    <div class="m-3">
                        <button class="btn btn-lg btn-success m-3 w-75" type="submit" name="submit" id="submit">Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "include/footer.php"; ?>
