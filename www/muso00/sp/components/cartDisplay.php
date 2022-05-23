<?php require './db/ProductsDB.php' ?>
<?php
$productsDB = new ProductsDB();

require './utils/update_item_qty.php';

if (isset($_GET['action'])) {
    require './utils/remove_cart_item.php';
    require './utils/remove_all_cart_items.php';
}
?>
<div>
    <div class="container shadow rounded mx-auto p-5">
        <div class="row bold mb-2 text-center">
            <div class="col text-primary">Item summary</div>
            <div class="col text-secondary">Shipping and payment</div>
            <div class="col text-secondary">Delivery details</div>
            <div class="col text-secondary">Order summary</div>
        </div>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    <div class="container">
        <div class="shadow rounded mx-auto p-5 mt-4">
            <div class="row mb-2">
                <div class="col">
                    <h4>Item summary</h4>
                </div>
            </div>
            <div class="row">
                <?php
                $subtotal = 0;
                if (!empty($_SESSION['shopping_cart'])) {
                    foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                        $id = $values['item_id'];
                        $res = $productsDB->fetchById($id);
                        $items = $res->fetchAll()[0];
                        ?>
                        <div class="row shadow-sm mb-3 d-flex h-100">
                            <div class="col justify-content-center align-self-center"><a href="./product.php?id=<?php echo $id; ?>"><?php echo $items['name']; ?></a></div>
                            <div class="col justify-content-center align-self-center text-end">
                                <form method="POST" action="cart.php?action=update&id=<?php echo $id; ?>">
                                    <input type="number" name="newQty" min="1" max="<?php echo $items['stock']; ?>" value="<?php echo $values['item_qty']; ?>">
                                    <button class="btn btn-success"><i class="bi bi-check2"></i></button>
                                </form>
                            </div>
                            <div class="col justify-content-center align-self-center text-end">$<?php echo number_format($values['item_qty'] * $values['item_price'], 2); ?></div>
                            <div class="col p-3 justify-content-center align-self-center"><a href="?action=delete&id=<?php echo $id; ?>" class="btn btn-outline-danger float-end">Remove</a></div>
                        </div>
                    <?php
                        $subtotal = $subtotal + ($values['item_qty'] * $items['price']);
                    }
                    ?>
                    <div class="row bold">
                        <hr />
                        <div class="col">Subtotal</div>
                        <div class="col"></div>
                        <div class="col text-end">$<?php echo number_format($subtotal, 2); ?></div>
                        <div class="col"><a href="?action=deleteAll" class="btn btn-outline-danger float-end">Remove all</a></div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mt-4 mb-5">
            <div class="col"><a class="btn btn-secondary" href="./products.php"><i class="bi bi-bag-plus-fill"></i>&nbsp;Keep shopping</a></div>
            <div class="col"><a class="btn btn-success float-end" href="./shipping.php">Next step <i class="bi bi-arrow-right"></i></a></div>
        </div>
    </div>
</div>