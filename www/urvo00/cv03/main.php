<h1>Registration form</h1>
<?php foreach ($errors as $error) : ?>
    <div class="error"><?php echo $error; ?> </div>
<?php endforeach; ?>
<form class="form-signup" method="POST">
    <div class="form-group">
        <label for="name">Name*</label>
        <input class="form-control" name="name" value="<?php echo isset($name) ? $name : ''; ?>" required>
    </div>
    <div class="form-group">
        <label for="gender">Gender*</label>
        <select class="form-control" name="gender" required>
            <option value="O" <?php echo isset($gender) && $gender == 'O' ? 'selected' : ''; ?>>Other</option>
            <option value="F" <?php echo isset($gender) && $gender == 'F' ? 'selected' : ''; ?>>Female</option>
            <option value="M" <?php echo isset($gender) && $gender == 'M' ? 'selected' : ''; ?>>Male</option>
        </select>
    </div>
    <div class="form-group">
        <label for="email">Email*</label>
        <input class="form-control" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone*</label>
        <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>" required>
    </div>
    <div class="form-group">
        <label for="avatar">Avatar URL*</label>
        <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : ''; ?>" required>
        <?php if (isset($avatar)) : ?>
            <img src="<?php echo $avatar; ?>" alt="avatar">
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="deck">Deck name*</label>
        <input class="form-control" name="deck" value="<?php echo isset($deck) ? $deck : ''; ?>" required>
    </div>
    <div class="form-group">
        <label for="cards">Number of cards in deck*</label>
        <input class="form-control" name="cards" value="<?php echo isset($cards) ? $cards : ''; ?>" required>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>