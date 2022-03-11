<h1>PHP Registration form</h1>
<main>
    <form action="." method="POST">
        <?php foreach ($errors as $error) : ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endforeach; ?>
        <div>
            <label for="name">Type your name</label>
            <input value="<?php echo isset($name) ? $name : '' ?>" name="name" required pattern="\w{3,}">
            <small class="decription">Example: John</small>
        </div>
        <div>
            <label for="gender">Select your gender</label>
            <select name="gender">
                <option <?php echo isset($gender) && $gender === 'N' ? 'selected' : ''; ?> value="N">Neutral</option>
                <option <?php echo isset($gender) && $gender === 'F' ? 'selected' : ''; ?> value="F">Female</option>
                <option <?php echo isset($gender) && $gender === 'M' ? 'selected' : ''; ?> value="M">Male</option>
            </select>
        </div>
        <div>
            <label for="email">Your email*</label>
            <input value="<?php echo isset($email) ? $email : '' ?>" name="email" required type="email">
            <small class="decription">Example: example@example.com</small>
        </div>
        <div>
            <label for="phone">Your phone number*</label>
            <input value="<?php echo isset($phone) ? $phone : '' ?>" name="phone" required>
            <small class="decription">Example: +000 000 000 000</small>
        </div>
        <div>
            <label for="avatar">URL of avatar*</label>
            <input value="<?php echo isset($avatar) ? $avatar : '' ?>" name="avatar" required>
            <small class="decription">Example: https://www.example.com/</small>
            <?php if (isset($avatar)) : ?>
                <img src="<?php echo $avatar; ?>" alt="avatar">
            <?php endif; ?>
        </div>
        <div>
            <label for="deck">Deck name*</label>
            <input value="<?php echo isset($deck) ? $deck : '' ?>" name="deck" required>
        </div>
        <div>
            <label for="count">Number of cards in the deck*</label>
            <input type="number" value="<?php echo isset($deckCount) ? $deckCount : '' ?>" name="count" min="0">
        </div>
        <button>Submit</button>
    </form>
</main>