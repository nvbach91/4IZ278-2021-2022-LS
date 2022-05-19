<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="form-profile mb-5 form rounded shadow mx-auto p-5">
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach ($errors as $error) : ?>
                <div><?php echo $error; ?></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="container">
        <h4 id="account-info">Account information</h4>
        <div class="row align-items-start">
            <div class="col">
                <label class="form-label" for="email">Email address</label>
                <input class="form-control" value="<?php echo @$email; ?>" name="email" readonly>
            </div>
        </div>
        <div class="row align-items-start">
            <div class="col">
                <label class="form-label" for="firstName">First Name</label>
                <input class="form-control" value="<?php echo @$firstName; ?>" name="firstName">
            </div>
            <div class="col">
                <label class="form-label" for="lastName">Last Name</label>
                <input class="form-control" value="<?php echo @$lastName; ?>" name="lastName">
            </div>
        </div>
        <div class="row align-items-start">
            <div class="col">
                <label class="form-label" for="phone">Phone number</label>
                <input class="form-control" value="<?php echo @$phone; ?>" name="phone" placeholder="Example: +420 123 456 789">
            </div>
        </div>
        <h4 id="account-info" class="mt-5">Delivery details</h4>
        <div class="row align-items-start">
            <div class="col">
                <label class="form-label" for="city">City</label>
                <input class="form-control" value="<?php echo @$city; ?>" name="city" placeholder="Example: Syracuse">
            </div>
        </div>
        <div class="row align-items-start">
            <div class="col">
                <label class="form-label" for="street">Street</label>
                <input class="form-control" value="<?php echo @$street; ?>" name="street" placeholder="Example: Saint Marys Avenue 1065">
            </div>
            <div class="col">
                <label class="form-label" for="postalCode">Postal code</label>
                <input class="form-control" value="<?php echo @$postalCode; ?>" name="postalCode" placeholder="Example: 13202">
            </div>
        </div>
        <div class="row justify-content-center">
            <button class="btn btn-secondary btn-profile mt-5">Save changes</button>
        </div>
    </div>
</form>