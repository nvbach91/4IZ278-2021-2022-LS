<?php  include 'inc/header.php'; ?>
<?php  require 'db/ProductsDB.php'?>

<?php
$productsDB = new ProductsDB();
$cat_id = 2;
$cat_name = 'Hovězí jerky';
$itemsPerPage = 6;
$cat_get = 'hovezi';

if(!empty($_GET['category'])) {
    if ($_GET['category'] == 'hovezi') {
        $cat_id = 2;
        $cat_name = 'Hovězí jerky';
        $cat_get = 'hovezi';
    }
    if ($_GET['category'] == 'veprove') {
        $cat_id = 3;
        $cat_name = 'Vepřové jerky';
        $cat_get = 'veprove';
    }
    if ($_GET['category'] == 'kruti') {
        $cat_id = 4;
        $cat_name = 'Krůtí jerky';
        $cat_get = 'kruti';
    }
    if ($_GET['category'] == 'zverinove') {
        $cat_id = 5;
        $cat_name = 'Zvěřinové jerky';
        $cat_get = 'zverinove';
    }
}

if (isset($_GET['offset'])) {
    $offset = (int)$_GET['offset'];
} else {
    $offset = 0;
}

if($offset % $itemsPerPage != 0){
    $offset = floor($offset/$itemsPerPage)*$itemsPerPage;
}

//url base for pagination
$link = 'products.php?category='.$cat_get.'&offset=';

$count = $productsDB->countItems($cat_id);

$products = $productsDB->fetchByCategory($cat_id, $offset, $itemsPerPage);
?>
<h1 class="text-center text-black mt-5"><?php echo $cat_name?></h1>
<div class="d-flex w-75 mx-auto justify-content-center flex-wrap">

    <?php foreach ($products as $product):?>
        <div class="card m-5" style="width:300px;height: auto">
            <div class="container w-100 p-0 overflow-hidden" style="height: 200px">
                <a href="item.php?id=<?php echo $product['prod_id'] ?>">
                    <img class="card-img-top" src="<?php echo(file_exists('res/items/'.$product['img_link'])) ?'res/items/'.$product['img_link']: 'res/placeholder.png'; ?>" alt="Náhled produktu " width="300" height="auto">
                </a>
            </div>
            <div class="card-body text-black">
                <h4 class="card-title"><?php echo $product['prod_name'] ?></h4>
                <div class="d-flex flex-column ">
                    <p class="card-text overflow-hidden mb-0" style="height: 4.5em"><?php echo $product['description'] ?></p>
                    <a href="item.php?id=<?php echo $product['prod_id'] ?>" class="align-self-end">Více informací</a>
                </div>
                <h5><?php echo $product['size'] ?></h5>
                <h4><?php echo $product['price'] ?> Kč</h4>
                <form method="post" action="functions/addToCart">
                    <div class="d-flex justify-content-between mt-4">
                        <input type="hidden" name="id" value="<?php echo $product['prod_id']?>">
                        <input type="hidden" name="url" value="<?php echo $link.$offset ?>">
                        <button type="submit" class="btn btn-primary">Přidat do košíku</button>
                        <?php if(!empty($_SESSION['lg_privileges'])&&$_SESSION['lg_privileges'] == 2):?>
                            <a href="updateItem.php?id=<?php echo $product['prod_id'] ?>" class="btn btn-warning"><img src="res/icons/edit.svg" title="Upravit produkt" alt="Upravit produkt"></a>
                            <a href="deleteItem.php?id=<?php echo $product['prod_id'] ?>" class="btn btn-secondary"><img src="res/icons/delete.svg" title="Smazat produkt" alt="Smazat produkt"></a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="d-flex justify-content-center">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link <?php echo $offset-$itemsPerPage< 0 ? "disabled" : "";?>" href="<?php echo $link.($offset-$itemsPerPage); ?>">
                    Předchozí
                </a>
            </li>
           <?php for ($i = 1; $i <= ceil($count / $itemsPerPage); $i++): ?>
               <li class="page-item">
                   <a class="page-link <?php echo $offset / $itemsPerPage + 1 == $i ? "active" : ""; ?>" href="<?php echo $link.(($i - 1) * $itemsPerPage); ?>">
                       <?php echo $i; ?>
                   </a>
               </li>
            <?php endfor; ?>
            <li class="page-item">
                <a class="page-link <?php echo $offset+$itemsPerPage>= $count ? "disabled" : "";?>" href="<?php echo $link.($offset+$itemsPerPage); ?>">
                    Další
                </a>
            </li>
        </ul>
</div>
<?php include "inc/footer.php";?>

