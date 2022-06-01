<?php require 'inc/header.php'?>
<?php require 'db/ProductsDB.php' ?>

<?php

if (empty($_GET['id'])){
    header('Location: fb_login.php');
    exit();
}

$productsDB = new ProductsDB();
$item = $productsDB->fetchById($_GET['id'])[0];

if (empty($item)){
    header('Location: fb_login.php');
    exit();
}
?>

<h1 class="text-center text-black mt-5"><?php echo $item['prod_name'] ?></h1>
<div class="d-flex w-25 mx-auto justify-content-center">
    <div class="card my-5" style="height: auto">
        <div class="container w-100 p-0">
            <img class="card-img-top" src="<?php echo(file_exists('res/items/'.$item['img_link'])) ?'res/items/'.$item['img_link']: 'res/placeholder.png'; ?>" alt="Náhled produktu " width="300" height="auto">
        </div>
        <div class="card-body text-black">
            <p class="card-text" style="min-height: 100px"><?php echo $item['description'] ?></p>
            <h5><?php echo $item['size'] ?></h5>
            <h4><?php echo $item['price'] ?> Kč</h4>
            <form method="post" action="functions/addToCart">
                <div class="d-flex mt-4">
                    <input type="hidden" name="id" value="<?php echo $item['prod_id']?>">
                    <input type="hidden" name="url" value="<?php echo 'item?id='.$item['prod_id'] ?>">
                    <button type="submit" class="btn btn-primary m-1">Přidat do košíku</button>
                    <?php if(!empty($_SESSION['lg_privileges'])&&$_SESSION['lg_privileges'] == 2):?>
                        <a href="updateItem.php?id=<?php echo $item['prod_id'] ?>" class="btn btn-warning m-1"><img src="res/icons/edit.svg" title="Upravit produkt" alt="Upravit produkt"></a>
                        <a href="deleteItem.php?id=<?php echo $item['prod_id'] ?>" class="btn btn-secondary m-1"><img src="res/icons/delete.svg" title="Smazat produkt" alt="Smazat produkt"></a>
                    <?php endif; ?>
                        <a href="products.php" class="btn btn-primary m-1 ms-auto">Zpět</a>
                </div>
            </form>
        </div>
    </div>
</div>



<?php  require 'inc/footer.php'?>
