<?php
$title = 'Cart';
session_start();
?>
<?php require __DIR__ . '/db/UsersDB.php'; ?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<?php
if (!isset($_SESSION['user_id'])) {
    exit('<div class="alert alert-warning text-center" role="alert">You are not signed in. <a href="./signin.php" class="stretched-link link-warning">Sign In</a></div>');
}
?>

<main>
    <h1 class="text-center">Shopping cart</h1>
    <?php if (!isset($_SESSION['shopping_cart'])) : ?>
        <?php require __DIR__ . '/components/cartEmpty.php'; ?>
    <?php else : ?>
        <?php require __DIR__ . '/components/cartFilled.php'; ?>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/incl/foot.php'; ?>