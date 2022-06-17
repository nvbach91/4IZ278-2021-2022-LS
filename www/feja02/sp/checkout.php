<?php
include "include/header.php";
require "database/productsdb.php";
require "database/shippingdetailsdb.php";
require "functions/userCheck.php";

if (empty($_SESSION["cart"])) header("Location: ./cart");

$errorList = [];
if (!empty($_SESSION["errorList"])) {
    $errorList = $_SESSION["errorList"];
}

$firstName = "";
$lastName = "";
$email = "";
$phone = "";
$country = "";
$street = "";
$city = "";
$zip = "";

$shippingDb = new ShippingDetailsDB();
if (count($shippingDb->fetchByUserId($_SESSION["login_id"]))) {
    $shipping = $shippingDb->fetchByUserId($_SESSION["login_id"])[0];
    $firstName = $shipping["first_name"];
    $lastName = $shipping["last_name"];
    $email = $shipping["email"];
    $phone = $shipping["phone"];
    $country = $shipping["country"];
    $street = $shipping["street"];
    $city = $shipping["city"];
    $zip = $shipping["zip_code"];
}

if (!empty($_SESSION["errorDetails"])) {
    $firstName = $_SESSION["errorDetails"]["firstName"];
    $lastName = $_SESSION["errorDetails"]["lastName"];
    $email = $_SESSION["errorDetails"]["email"];
    $phone = $_SESSION["errorDetails"]["phone"];
    $country = $_SESSION["errorDetails"]["country"];
    $street = $_SESSION["errorDetails"]["street"];
    $city = $_SESSION["errorDetails"]["city"];
    $zip = $_SESSION["errorDetails"]["zip"];
}

$productsDb = new ProductsDB();
$items = [];
$total = 0.0;

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

<h1 class="text-center text-black mt-5">Shipping details</h1>
<div class="d-flex w-50 mx-auto text-black flex-column flex-wrap mt-4 mb-5">
    <form method="POST" action="./functions/checkout">
        <div class="row justify-content-center text-center">
            <div class="col-md-6">
                <div class="card my-5">
                    <div class="m-3">
                        <input class="form-control" value="<?php echo $firstName; ?>" name="firstName" type="text" placeholder="* First Name">
                    </div>
                    <div class="m-3">
                        <input class="form-control" value="<?php echo $lastName; ?>" name="lastName" type="text" placeholder="* Last Name">
                    </div>
                    <div class="m-3">
                        <input class="form-control" value="<?php echo $email; ?>" name="email" type="text" placeholder="* Email">
                    </div>
                    <div class="m-3">
                        <input class="form-control" value="<?php echo $phone; ?>" name="phone" type="text" placeholder="* Phone">
                    </div>
                    <div class="m-3">
                        <input class="form-control" value="<?php echo $country; ?>" name="country" type="text" placeholder="* Country/Region">
                    </div>
                    <div class="m-3">
                        <input class="form-control" value="<?php echo $street; ?>" name="street" type="text" placeholder="* Street address">
                    </div>
                    <div class="m-3">
                        <input class="form-control" value="<?php echo $city; ?>" name="city" type="text" placeholder="* Town/City">
                    </div>
                    <div class="m-3">
                        <input class="form-control" value="<?php echo $zip; ?>" name="zip" type="text" placeholder="* Postcode/ZIP">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <?php if (!empty($errorList)): ?>
                    <div class="m-3 alert alert-danger text-start">
                        <?php foreach ($errorList as $error): ?>
                            <h6><?php echo $error; ?></h6>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="card my-5">
                    <table class="table table-striped table-product">
                        <thead>
                            <tr class="align-middle">
                                <th>PRODUCT</th>
                                <th>SUBTOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                            <tr class="align-middle">
                                <td><?php echo $item["name"] . " × " . $item["quantity"]; ?></td>
                                <td>$<?php echo $item["quantity"] * $item["price"]; ?></td>
                            </tr>
                            <?php $total += $item["quantity"] * $item["price"]; ?>
                            <?php endforeach; ?>
                            <tr class="align-middle">
                                <td>EMS Shipping with tracking</td>
                                <td>$29.99</td>
                            </tr>
                            <tr>
                                <td><h5>Total:</h5></td>
                                <td>$<?php echo $total + 29.99; $_SESSION["cartTotal"] = $total + 29.99; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-success btn-rounded btn-lg mx-5 mb-3" href="./checkout">Proceed to Checkout</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php include "include/footer.php"; ?>
