<?php
$title = 'Cart';
$pageActive = 5;
session_start();
?>

<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<?php require __DIR__ . '/utils/user_required.php'; ?>
<main>
    <h1 class="text-center">Shopping cart</h1>
    <?php if (!isset($_SESSION['shopping_cart'])) : ?>
        <?php require __DIR__ . '/components/cartEmptyDisplay.php'; ?>
    <?php else : ?>
        <?php require __DIR__ . '/components/cartDisplay.php'; ?>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/incl/foot.php'; ?>