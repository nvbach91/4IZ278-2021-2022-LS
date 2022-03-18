<?php

require_once __DIR__ . '/../../models/forms/RegistrationForm.php';
require_once __DIR__ . '/../../db/UserDatabase.php';
require_once __DIR__ . '/../../db/models/User.php';

$form = RegistrationForm::fromData($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isValid = $form->validate();

    if ($isValid) { // successful form submit -> redirect to login screen
        $db = new UserDatabase();

        $user = new User([
            'name' => $form->getName(),
            'email' => $form->getEmail(),
            'password' => $form->getPassword(),
        ]);

        $insertSuccess = $db->insertUser($user);

        if ($insertSuccess) {
            $email = urlencode($form->getEmail());
            $url = "./login.php?email=$email";

            header("Location: $url");
            exit;
        }
    }
} else {
    $isValid = null; // null = not validated
}

?>

<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 offset-md-3 offset-lg-4">
        <h1 class="text-center">Registration</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 offset-md-3 offset-lg-4">
        <?php if ($isValid === false): ?>
            <div class="alert alert-danger" role="alert">
                Oops... there are some errors in the form.
            </div>
        <?php elseif(isset($insertSuccess) && $insertSuccess === false): ?>
            <div class="alert alert-danger" role="alert">
                Registration failed. DB error.
            </div>
        <?php endif; ?>
        <form id="registration-form" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input id="name" type="text" name="name" placeholder="Full name"
                       class="form-control <?= $form->getFieldValidityClass('name') ?>"
                       autocomplete="name" value="<?= $form->getName() ?>" aria-describedby="name-errors">
                <?php if ($form->isFieldInvalid('name')): ?>
                    <div id="name-errors" class="invalid-feedback">
                        <?php foreach ($form->getFieldErrors('name') as $error): ?>
                            <p><?= $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

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
                       autocomplete="new-password" value="<?= $form->getPassword() ?>"
                       aria-describedby="password-errors">
                <?php if ($form->isFieldInvalid('password')): ?>
                    <div id="password-errors" class="invalid-feedback">
                        <?php foreach ($form->getFieldErrors('password') as $error): ?>
                            <p><?= $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="password-confirm" class="form-label">Password confirmation</label>
                <input id="password-confirm" type="password" name="passwordConfirm" placeholder="Password confirmation"
                       class="form-control <?= $form->getFieldValidityClass('passwordConfirm') ?>"
                       value="<?= $form->getPasswordConfirmation() ?>" aria-describedby="password-confirm-errors">
                <?php if ($form->isFieldInvalid('passwordConfirm')): ?>
                    <div id="password-confirm-errors" class="invalid-feedback">
                        <?php foreach ($form->getFieldErrors('passwordConfirm') as $error): ?>
                            <p><?= $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="d-flex justify-content-between">
                <a href="./" class="btn btn-secondary">Home</a>
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
</div>