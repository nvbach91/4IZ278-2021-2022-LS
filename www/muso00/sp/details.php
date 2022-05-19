<?php
$title = 'Delivery details';
session_start();
?>
<?php require __DIR__ . '/db/UsersDB.php'; ?>
<?php include __DIR__ . '/incl/head.php'; ?>
<?php include __DIR__ . '/incl/nav.php'; ?>
<?php require __DIR__ . '/utils/user_required.php'; ?>
<?php require __DIR__ . '/utils/cart_empty.php'; ?>
<?php

$errors = [];

require __DIR__ . '/utils/fetch_user_info.php';

if (!empty($_POST)) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $phone = $_POST['phone'];

    $city = $_POST['city'];
    $street = $_POST['street'];
    $postalCode = $_POST['postalCode'];

    require __DIR__ . '/utils/name_validation.php';

    if (empty($phone)) {
        array_push($errors, 'Fill in the phone number');
    }
    if (empty($city)) {
        array_push($errors, 'Fill in the city');
    }
    if (empty($street)) {
        array_push($errors, 'Fill in the street');
    }
    if (empty($postalCode)) {
        array_push($errors, 'Fill in the postal code');
    }

    if (!count($errors)) {
        $_SESSION['order_fullname'] = "$firstName $lastName";
        $_SESSION['order_phone'] = $phone;
        $_SESSION['order_address'] = "$street, $city, $postalCode";

        header('Location: order.php');
        exit();
    }
}

?>
<main>
    <h1 class="text-center">Delivery details</h1>
    <div>
        <div class="container shadow rounded mx-auto p-5">
            <div class="row bold mb-2 text-center">
                <div class="col"><a href="cart.php" class="text-faded-primary">Item summary</a></div>
                <div class="col"><a href="shipping.php" class="text-faded-primary">Shipping and payment</a></div>
                <div class="col text-primary">Delivery details</div>
                <div class="col text-secondary">Order summary</div>
            </div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>

        <div>
            <div class="container">
                <form method="POST">
                    <div class="rounded shadow mx-auto p-4 mt-4">
                        <?php if (!empty($errors)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?php foreach ($errors as $error) : ?>
                                    <div class="error"><?php echo $error; ?></div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <div class="row p-3 pt-1">
                            <div class="col shadow-sm p-3 m-2">
                                <h4>User info</h4>
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label" for="firstName">First name</label>
                                        <input class="form-control" value="<?php echo @$firstName; ?>" name="firstName">
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="lastName">Last name</label>
                                        <input class="form-control" value="<?php echo @$lastName; ?>" name="lastName">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label" for="email">Email</label>
                                        <input class="form-control" value="<?php echo @$email; ?>" name="email" type="email" readonly>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <label class="form-label" for="email">Phone number</label>
                                        <input class="form-control" value="<?php echo @$phone; ?>" name="phone" placeholder="+420123456789">
                                    </div>
                                </div>
                                <div class="row">
                                </div>
                            </div>
                            <div class="col shadow-sm p-3 m-2">
                                <h4>Address</h4>
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label" for="city">City</label>
                                        <input class="form-control" value="<?php echo @$city; ?>" name="city" placeholder="Example: Syracuse">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label" for="street">Street</label>
                                        <input class="form-control" value="<?php echo @$street; ?>" name="street" placeholder="Example: Saint Marys Avenue 1065">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label class="form-label" for="postalCode">Postal code</label>
                                        <input class="form-control" value="<?php echo @$postalCode; ?>" name="postalCode" placeholder="Example: 13202">
                                    </div>
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
                <div class="mt-4"><a class="btn btn-secondary" href="./shipping.php"><i class="bi bi-arrow-left"></i> Back</a></div>
            </div>
        </div>
</main>
<?php include __DIR__ . '/incl/foot.php'; ?>