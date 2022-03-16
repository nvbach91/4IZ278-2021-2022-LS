<?php 
    $root = './';
?>

<?php include './includes/head.php'; ?>
<h1>Welcome to the page!</h1>
<main class="index-page">
    <div>
        <div>Don't have an account?</div>
        <div class="button" onclick="location.href='./registration.php';">Go to registration</div>
    </div>
    <div>
        <div>Already registered?</div>
        <div class="button"  onclick="location.href='./login.php';">Go to login</div>
    </div>
</main>

<?php include './includes/foot.php'; ?>