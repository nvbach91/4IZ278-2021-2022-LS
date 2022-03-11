<?php

require_once __DIR__ . '/../models/SignupForm.php';
require_once __DIR__ . '/../models/EmailSender.php';

$form = SignupForm::fromData($_POST);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isValid = $form->validate();

    if ($isValid) { // successful form submit -> send email and flush the form
        (new EmailSender())->sendEmail($form);
        $form->flush();
    }
} else {
    $isValid = null; // null = not validated
}

?>

<div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12 offset-md-3 offset-lg-4">
        <?php if ($isValid === false): ?>
            <div class="alert alert-danger" role="alert">
                Oops... there are some errors in the form.
            </div>
        <?php elseif ($isValid === true): ?>
            <div class="alert alert-success" role="alert">
                Congratulations! You have successfully registered into the card tournament.
            </div>
        <?php endif; ?>
        <form id="signup-form" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
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
                <label for="gender" class="form-label">Gender</label>
                <select id="gender" name="gender"
                        class="form-select <?= $form->getFieldValidityClass('gender') ?>"
                        autocomplete="sex" aria-describedby="gender-errors">
                    <option value="">-- Select option --</option>
                    <?php foreach (SignupForm::getGenders() as $gender => $label): ?>
                        <option value="<?= $gender ?>" <?= $form->getGender() === $gender ? 'selected' : '' ?>><?= $label ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if ($form->isFieldInvalid('gender')): ?>
                    <div id="gender-errors" class="invalid-feedback">
                        <?php foreach ($form->getFieldErrors('gender') as $error): ?>
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
                <label for="phone" class="form-label">Telephone number</label>
                <input id="phone" type="tel" name="phone"
                       class="form-control <?= $form->getFieldValidityClass('phone') ?>"
                       placeholder="Telephone number"
                       autocomplete="tel" value="<?= $form->getPhone() ?>" aria-describedby="phone-errors">
                <?php if ($form->isFieldInvalid('phone')): ?>
                    <div id="phone-errors" class="invalid-feedback">
                        <?php foreach ($form->getFieldErrors('phone') as $error): ?>
                            <p><?= $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="profile-pic" class="form-label">Profile picture</label>
                <input id="profile-pic" type="url" name="profilePic"
                       class="form-control <?= $form->getFieldValidityClass('profilePic') ?>"
                       placeholder="Profile picture URL" value="<?= $form->getProfilePicture() ?>"
                       aria-describedby="profile-pic-errors">
                <?php if ($form->isFieldInvalid('profilePic')): ?>
                    <div id="profile-pic-errors" class="invalid-feedback">
                        <?php foreach ($form->getFieldErrors('profilePic') as $error): ?>
                            <p><?= $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <div class="mt-3 <?= empty($form->getProfilePicture()) ? 'd-none' : '' ?>">
                    <img id="profile-pic-thumbnail" src="<?= $form->getProfilePicture() ?>" alt="User profile picture" class="img-thumbnail">
                </div>
            </div>

            <div class="mb-3">
                <label for="deck-name" class="form-label">Deck name</label>
                <input id="deck-name" type="text" name="deckName"
                       class="form-control <?= $form->getFieldValidityClass('deckName') ?>"
                       placeholder="Deck name"
                       value="<?= $form->getDeckName() ?>" aria-describedby="deck-name-errors">
                <?php if ($form->isFieldInvalid('deckName')): ?>
                    <div id="deck-name-errors" class="invalid-feedback">
                        <?php foreach ($form->getFieldErrors('deckName') as $error): ?>
                            <p><?= $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="deck-number" class="form-label">Number of cards in deck</label>
                <input id="deck-number" type="number" name="deckNumber" min="1"
                       class="form-control <?= $form->getFieldValidityClass('deckNumber') ?>"
                       placeholder="5"
                       value="<?= $form->getDeckNumber() ?>" aria-describedby="deck-number-errors">
                <?php if ($form->isFieldInvalid('deckNumber')): ?>
                    <div id="deck-number-errors" class="invalid-feedback">
                        <?php foreach ($form->getFieldErrors('deckNumber') as $error): ?>
                            <p><?= $error ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Load the thumbnail on the fly
    document.getElementById('profile-pic').addEventListener('input', function (e) {
        const { target } = e
        const thumbnail = document.getElementById('profile-pic-thumbnail')

        if (target.value) {
            thumbnail.parentElement.classList.remove('d-none') // show the thumbnail
            thumbnail.src = target.value
        } else {
            thumbnail.parentElement.classList.add('d-none') // hide the thumbnail
        }
    })
</script>