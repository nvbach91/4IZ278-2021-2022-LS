<?php
include "include/header.php";

if (!empty($_SESSION["login_id"])) {
    header("Location: /");
    exit();
}

$email = "";
if (isset($_GET["email"])) $email = $_GET["email"];
?>

<h1 class="text-center text-black mt-5">Login</h1>
<div class="d-flex w-50 mx-auto text-black flex-column flex-wrap mt-4 mb-5">
    <div class="row justify-content-center text-center">
        <div class="col-md-5">
            <div class="card my-5">
                <form method="POST" action="./functions/login">
                    <?php if (!empty($_GET["reg"])): ?>
                    <div class="m-3 alert alert-success">
                        <h6>Successfully registered!</h6>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($_GET["error"])): ?>
                    <div class="m-3 alert alert-danger">
                        <h6>Invalid e-mail or password!</h6>
                    </div>
                    <?php endif; ?>
                    <div class="m-3">
                        <input class="form-control" value="<?php echo $email; ?>" name="email" type="text" placeholder="Email Address">
                    </div>
                    <div class="m-3">
                        <input class="form-control" name="password" type="password" placeholder="Password">
                    </div>
                    <div class="m-3">
                        <button class="btn btn-lg btn-success m-3 w-75" type="submit" name="submit" id="submit">Login</button>
                    </div>
                    <div class="form-text text-center m-3 text-dark">
                        <h6>Not registered? <a href="./register"> Create an Account</a>.</h6>
                    </div>
                </form><hr class="w-75 mx-auto">
                <div class="">
                    <h6>Or Login with:</h6>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "include/footer.php"; ?>
