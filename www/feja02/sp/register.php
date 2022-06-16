<?php
include "include/header.php";

if (!empty($_SESSION["login_id"])) {
    header("Location: /");
    exit();
}

$errorList = [];
if (!empty($_SESSION["errorList"])) {
    $errorList = $_SESSION["errorList"];
}
?>

<script>
function disableSubmit() {
    document.getElementById("submit").disabled = true;
    console.log("called");
}

function activateButton(element) {
    if(element.checked) document.getElementById("submit").disabled = false;
    else document.getElementById("submit").disabled = true;
}
</script>

<h1 class="text-center text-black mt-5">Register</h1>
<div class="d-flex w-50 mx-auto text-black flex-column flex-wrap mt-4 mb-5">
    <div class="row justify-content-center text-center">
        <div class="col-md-5">
            <div class="card my-5">
                <form method="POST" action="./functions/register">
                    <?php if (!empty($errorList)): ?>
                    <div class="m-3 alert alert-danger text-start">
                        <?php foreach ($errorList as $error): ?>
                            <h6><?php echo $error; ?></h6>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <div class="m-3">
                        <input class="form-control" name="email" type="text" placeholder="Email Address">
                    </div>
                    <div class="m-3">
                        <input class="form-control" name="password" type="password" placeholder="Password">
                    </div>
                    <div class="m-3">
                        <input class="form-control" name="passwordConfirm" type="password" placeholder="Password Again">
                    </div>
                    <div class="m-3">
                        <input class="form-check-input" name="terms" id="terms" type="checkbox" onchange="activateButton(this)">
                        <label class="form-check-label" for="terms">
                            <h6>I agree with <a href="./terms">Terms of Service</a></h6>
                        </label>
                    </div>
                    <div class="m-3">
                        <button class="btn btn-lg btn-success m-3 w-75" type="submit" name="submit" id="submit">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>disableSubmit();</script>
<?php include "include/footer.php"; ?>
