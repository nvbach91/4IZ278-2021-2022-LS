<?php
include "include/header.php";
require "database/productsdb.php";

$productsDb = new ProductsDB();
$items = [];
$total = 0.0;

if (!isset($_SESSION["cart"])) $_SESSION["cart"] = [];

foreach ($_SESSION["cart"] as $key => $data) {
    $product = $productsDb->fetchById($data["id"])[0];
    if (is_array($product)) {
        $item = [
            "id" => $product["id"],
            "name" => $product["name"],
            "price" => $product["price"],
            "image" => $product["image"],
            "quantity" => $data["quantity"]
        ];
        array_push($items, $item);
    }
}

?>

<h1 class="text-center text-black mt-5">Cart</h1>
<div class="d-flex w-50 mx-auto text-black flex-column flex-wrap mt-4 mb-5">
    <form method="POST" action="./functions/updateCart.php">
        <table class="table table-striped table-product">
            <thead>
                <tr class="align-middle">
                    <th> </th>
                    <th>PRODUCT</th>
                    <th>QUANTITY</th>
                    <th>PRICE</th>
                    <th>SUBTOTAL</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr class="align-middle">
                    <td><a class="table-link text-reset text-decoration-none" href="./product?id=<?php echo $item["id"]; ?>"><img src="<?php echo $item["image"]; ?>" alt="" width="100"></a></td>
                    <td><a class="table-link text-reset text-decoration-none" href="./product?id=<?php echo $item["id"]; ?>"><?php echo $item["name"]; ?></a></td>
                    <td>
                        <input type="number"  min="1" max="100" class="form-control-custom" name="quantityId<?php echo $item["id"]; ?>" value="<?php echo $item["quantity"]; ?>">
                    </td>
                    <td>$<?php echo $item["price"]; ?></td>
                    <td>$<?php echo $item["quantity"] * $item["price"]; ?></td>
                    <td>
                        <button class="btn" type="submit" name="deleteId" value="<?php echo $item["id"]; ?>"><img src="resources/delete32.png" alt="delete"></button>
                    </td>
                </tr>
                <?php $total += $item["quantity"] * $item["price"]; ?>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><h5>Total:</h5></td>
                    <td>$<?php echo $total; ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div class="text-end">
            <button class="btn btn-primary btn-rounded mx-2" type=submit>Update cart</button>
            <a class="btn btn-success btn-rounded btn-lg mx-2" href="./checkout">Proceed to Checkout</a>
        </div>
    </form>
</div>

<?php include "include/footer.php"; ?>
