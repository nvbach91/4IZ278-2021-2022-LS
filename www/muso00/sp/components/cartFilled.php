<?php require './db/ProductsDB.php' ?>
<?php
$productsDB = new ProductsDB();
if (!empty($_POST)) {
    $newQty = $_POST['newQty'];

    if ($_GET['action'] == 'update') {
        foreach ($_SESSION['shopping_cart'] as $keys => $values) {
            if ($values['item_id'] == $_GET['id']) {
                //unset($_SESSION['shopping_cart'][$keys]);
                $_SESSION['shopping_cart'][$keys]['item_qty'] = $newQty;
                header('Location: cart.php');
                exit();
            }
        }
    }
}

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'delete') {
        foreach ($_SESSION['shopping_cart'] as $keys => $values) {
            if ($values['item_id'] == $_GET['id']) {
                unset($_SESSION['shopping_cart'][$keys]);
                header('Location: cart.php');
            }
        }
    }
}
?>
<div>
    <div class="container shadow rounded mx-auto p-5">
        <div class="row bold mb-2">
            <div class="col">Item summary</div>
            <div class="col">Shipping and payment</div>
            <div class="col">Delivery details</div>
        </div>
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
    </div>
    <div class="container shadow rounded mx-auto p-5 mt-4">
        <div class="row">
            <div class="col">
                <h4>Item summary</h4>
            </div>
            <div class="col"><button type="button" class="btn-close float-end" aria-label="Close" title="Clear shopping cart"></button></div>
        </div>
        <div class="row">
            <?php
            $total = 0;
            if (!empty($_SESSION['shopping_cart'])) {
                foreach ($_SESSION['shopping_cart'] as $keys => $values) {
            ?>
                    <?php
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
                        <div class="col justify-content-center align-self-center text-end">$<?php echo number_format($values['item_qty'] * $items['price'], 2); ?></div>
                        <div class="col p-3 justify-content-center align-self-center"><a href="cart.php?action=delete&id=<?php echo $id; ?>" class="btn btn-outline-danger float-end">Remove</a></div>
                    </div>
                <?php
                    $total = $total + ($values['item_qty'] * $items['price']);
                }
                ?>
                <div class="row bold">
                    <hr />
                    <div class="col">Subtotal</div>
                    <div class="col"></div>
                    <div class="col text-end">$<?php echo number_format($total, 2); ?></div>
                    <div class="col"></div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="container">
        <div class="row mt-4 mb-5">
            <div class="col"><a class="btn btn-secondary" href="./products.php">Keep shopping</a></div>
            <div class="col"><a class="btn btn-success float-end" href="#">Next step <i class="bi bi-arrow-right"></i></a></div>
        </div>
    </div>
</div>