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
        <label for="email">Email*</label>
        <input class="form-control" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
    </div>
    <div class="form-group">
        <label for="password">Password*</label>
        <input class="form-control" name="password" value="<?php echo isset($password) ? $password : ''; ?>" required>
    </div>
    <div class="form-group">
        <label for="confirm-password">Confirm password*</label>
        <input class="form-control" name="cPassword" value="<?php echo isset($cPassword) ? $cPassword : ''; ?>" required>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</form>