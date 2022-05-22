<?php
$title = 'Home';
$pageActive = 1;
session_start();
?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5 index-container">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Welcome to our store!</h1>
            <p class="lead fw-normal text-white-50 mb-0">Purchase your favourite liquour from the comfort of your home</p>
            <a href="./products.php" class="btn btn-outline-warning rounded">Explore</a>
        </div>
    </div>
</header>
<!-- Main-->
<main class="py-5">
    <div class="text-secondary w-75 mx-auto mb-2 ps-3">
        <small>BLOG</small>
    </div>
    <section class="w-75 mx-auto shadow p-5 rounded">
       <?php require __DIR__ . '/components/blogDisplay.php'; ?>
    </section>
</main>
<?php include __DIR__ . '/incl/foot.php'; ?>