<?php
$title = 'Shipping and Payment';
$pageActive = 5;
session_start();
?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<?php require __DIR__ . '/utils/user_required.php'; ?>
<?php require __DIR__ . '/utils/cart_empty.php'; ?>
<?php require __DIR__ . '/db/DeliveryDB.php'; ?>
<?php

$deliveryDB = new DeliveryDB();
$deliveryTypes = $deliveryDB->fetchAll();

$errors = [];

if (isset($_POST['delivery']) && isset($_POST['payment'])) {
    $_SESSION['delivery_id'] = $_POST['delivery'];
    $_SESSION['payment'] = $_POST['payment'];
    header('Location: details.php');
    exit();
} else {
    array_push($errors, 'Choose delivery and payment method');
}

?>
<main>
    <h1 class="text-center">Shipping and payment</h1>
    <div>
        <div class="container shadow rounded mx-auto p-5">
            <div class="row bold mb-2 text-center">
                <div class="col"><a href="cart.php" class="text-faded-primary">Item summary</a></div>
                <div class="col text-primary">Shipping and payment</div>
                <div class="col text-secondary">Delivery details</div>
                <div class="col text-secondary">Order summary</div>
            </div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>

        <div>
            <div class="container">
                <form method="POST">
                    <div class="rounded shadow mx-auto p-4 mt-4">
                        <?php if (!empty($errors)) : ?>
                            <div class="alert alert-info" role="alert">
                                <?php foreach ($errors as $error) : ?>
                                    <div class="error"><?php echo $error; ?></div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <div class="row p-3 pt-1">
                            <div class="col shadow-sm p-3 m-2">
                                <h4>Delivery method</h4>
                                <?php foreach ($deliveryTypes as $deliveryType) : ?>
                                    <div class="row">
                                        <div class="col"><input type="radio" name="delivery" value="<?php echo $deliveryType['delivery_type_id']; ?>" <?php if (isset($_SESSION['delivery_id']) && $_SESSION['delivery_id'] == $deliveryType['delivery_type_id'])  echo 'checked'; ?>>&nbsp;
                                            <label class="form-label"><?php echo $deliveryType['name']; ?></label>
                                        </div>
                                        <div class="col text-secondary"><small class="align-middle">+&nbsp;$<?php echo $deliveryType['price']; ?></small></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="col shadow-sm p-3 m-2">
                                <h4>Payment method <span class="fs-6" title="Both payment methods are made upon receipt of the goods"><i class="bi bi-info-circle"></i></span></h4>
                                <div><input type="radio" name="payment" value="Credit card" <?php if (isset($_SESSION['payment']) && $_SESSION['payment'] == 'Credit card')  echo 'checked'; ?>>&nbsp;
                                    <label class="form-label">Credit card</label>
                                </div>
                                <div><input type="radio" name="payment" value="Cash" <?php if (isset($_SESSION['payment']) && $_SESSION['payment'] == 'Cash')  echo 'checked'; ?>>&nbsp;
                                    <label class="form-label">Cash</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row w-25 float-end">
                        <div class="col mt-4"><button type="submit" class="btn btn-success float-end">Next step <i class="bi bi-arrow-right"></i></button></div>
                    </div>
                </form>
            </div>
            <div class="container mb-5">
                <!-- back button-->
                <div class="mt-4"><a class="btn btn-secondary" href="./cart.php"><i class="bi bi-arrow-left"></i> Back</a></div>
            </div>
        </div>
    </div>
</main>
<?php include __DIR__ . '/incl/foot.php'; ?>