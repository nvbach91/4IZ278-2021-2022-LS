<?php
$title = 'Order complete';
session_start();
?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<?php require __DIR__ . '/utils/user_required.php'; ?>
<main>
    <div class="container w-25 mt-5">
        <div class="row text-center">
            <h1>Thank you for your purchase!</h1>
        </div>
        <div class="row text-secondary fs-6">
            <p class="text-center">We are now preparing your order. The summary was sent to your email address.</p>
        </div>
        <div class="row mx-auto p-3 w-50"><a href="./index.php" class="btn btn-outline-warning">Homepage</a></div>
    </div>
</main>
<?php require __DIR__ . '/incl/foot.php'; ?>