<?php

$validation = validateForm();

?>

<body>
    <div class="container">
        <form class="form-signup" method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
            <?php if (!empty($validation['errors'])): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($validation['errors'] as $error): ?>
                            <li>Invalid <?= $error ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>
            <?php if (empty($validation['errors']) && !empty($validation['data'])) :?>
                <div class="alert alert-success">Successfully submitted</div>
            <?php endif ?>
            <?php if(isset($validation['data']['avatar']) && !in_array('avatar', $validation['errors'])): ?>
                <img src="<?= $validation['data']['avatar'] ?>" alt="avatar">
            <?php endif ?>
            <div class="form-group">
                <label>Name*</label>
                <input class="form-control" name="name" value="<?= $validation['data']['name'] ?? null ?>">
            </div>
            <div class="form-group">
                <label>Email*</label>
                <input class="form-control" name="email" value="<?= $validation['data']['email'] ?? null ?>">
            </div>
            <div class="form-group">
                <label>Gender*</label>
                <select class="form-select" name="gender">
                    <option value="M" <?= isset($validation['data']['gender']) && $validation['data']['gender'] === 'M' ? 'selected' : null ?>>Male</option>
                    <option value="F" <?= isset($validation['data']['gender']) && $validation['data']['gender'] === 'F' ? 'selected' : null ?>>Female</option>
                    <option value="O" <?= isset($validation['data']['gender']) && $validation['data']['gender'] === 'O' ? 'selected' : null ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label>Phone*</label>
                <input class="form-control" name="phone" placeholder="+420123456789" value="<?= $validation['data']['phone'] ?? null ?>">
            </div>
            <div class="form-group">
                <label>Avatar URL*</label>
                <input class="form-control" name="avatar" value="<?= $validation['data']['avatar'] ?? null ?>">
            </div>
            <div class="form-group">
                <label>Deck name*</label>
                <input class="form-control" name="deckName" value="<?= $validation['data']['deckName'] ?? null ?>">
            </div>
            <div class="form-group">
                <label>Cards in deck*</label>
                <input class="form-control" name="cardsInDeck" value="<?= $validation['data']['cardsInDeck'] ?? null ?>">
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</body>
