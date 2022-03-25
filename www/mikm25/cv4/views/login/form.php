<?php

require_once __DIR__ . '/../../models/forms/LoginForm.php';

$additionalData = [];

// Get user email from query string redirected from registration
if (isset($_GET['email']) && !empty($_GET['email'])) {
    $additionalData['email'] = $_GET['email'];
}

$form = LoginForm::fromData(array_merge($_POST, $additionalData));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isValid = $form->validate();

    if ($isValid) { // successful form submit -> login user && redirect to dashboard
        header("Location: ./dashboard.php");
        exit;
    }
} else {
    $isValid = null; // null = not validated
}

?>

<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 offset-md-3 offset-lg-4">
        <h1 class="text-center">Login</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 offset-md-3 offset-lg-4">
        <?php if ($isValid === false): ?>
            <div class="alert alert-danger" role="alert">
                Oops... there are some errors in the form.
            </div>
        <?php endif; ?>
        <form id="login-form" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email"
                       class="form-control <?= $form->getFieldValidityClass('email') ?>"
                       placeholder="Email"
                       autocomplete="email" value="<?= $form->getEmail() ?>" aria-describedby="email-errors">
                <?php if ($form->isFieldInvalid('email')): ?>
                    <div id="email-errors" class="invalid-feedback">
                        <?php foreach ($form->getFieldErrors('email') as $error): ?>
                            <p><?= $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" placeholder="Password"
                       class="form-control <?= $form->getFieldValidityClass('password') ?>"
                       autocomplete="current-password" value="<?= $form->getPassword() ?>"
                       aria-describedby="password-errors">
                <?php if ($form->isFieldInvalid('password')): ?>
                    <div id="password-errors" class="invalid-feedback">
                        <?php foreach ($form->getFieldErrors('password') as $error): ?>
                            <p><?= $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="d-flex justify-content-between">
                <a href="./" class="btn btn-secondary">Home</a>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>