<?php require 'inc/header.php' ?>
<?php require 'functions/adminRequired.php' ?>
<?php require 'db/ProductsDB.php'?>

<?php
$item = [];

if (!empty($_GET['id'])){
$productsDB = new ProductsDB();
$item = $productsDB->fetchById($_GET['id'])[0];
}

if (empty($item)&&empty($_GET['success'])){
    header('Location: fb_login.php');
    exit();
}
?>

<div class="conainer w-25 m-auto text-black">
    <?php if(!empty($_GET['success'])): ?>
        <h5 class="text-success">Položka byla úspěšně odstraněna</h5>
    <?php else: ?>
        <h5>Opravdu chcete odstranit následující položku?</h5>
        <h6>Název: <?php echo $item['prod_name'] ?></h6>
        <h6>Velikost: <?php echo $item['size'] ?></h6>
        <h6>Cena: <?php echo $item['price'] ?> Kč</h6>
        <form method="post" action="ctrl/deleteItemController">
            <input type="hidden" name="id" value="<?php echo $item['prod_id'] ?>">
            <button type="submit" class="btn btn-primary">Odstranit produkt</button>
        </form>
    <?php endif; ?>
</div>

<?php require 'inc/footer.php' ?>
