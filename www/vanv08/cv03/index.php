<?php include './includes/header.php'; ?>


<?php
    $errors = [];
    //var_dump($_POST);

    if(!empty($_POST)){
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $avatar = $_POST['avatar'];
    $deckname = $_POST['deckname'];
    $cards = $_POST['cards'];
    
    

    if (strlen($name) < 3) {
            array_push($errors, 'Wrong name');
    }

    if (!in_array($gender, ['N','F','M'])) {
        array_push($errors, 'Wrong haccer');
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, 'Wrong email');
    }

    if (!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)) {
        array_push($errors, 'Wrong phone');
        
    }
    
    if (!filter_var($avatar, FILTER_VALIDATE_URL)){
        array_push($errors, 'Wrong avatar url');
    }
    
    if (strlen($deckname) < 3) {
        array_push($errors, 'Wrong deckname');
    }   
    
    
    if(!preg_match('/^[1-9][0-9]?$|^100$/',$cards)){
        array_push($errors, 'Wrong number of cards choose: 1-100');
    }
    if (!count($errors)){
        header('Location: ./registration-success.php');
        exit();
    }
    
}

    ?>

<main>
    <h1 class="text-center">Registration page</h1>
    <div class="form-area">
        <form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="alert alert-danger">
                <?php 
        foreach($errors as $error): ?>
                <div class="error"><?= $error; ?></div>
                <?php endforeach; ?>
            </div>
            <div class="form-group">
                <label>Name*</label>
                <input class="form-control" name="name" value="<?php echo isset($name) ? $name : '' ?>">
            </div>
            <div class="form-group">
                <label for="gender">Select your gender</label><br>
                <select name="gender">
                    <option value="N" <?php echo isset($gender) && $gender === 'N' ? 'selected': '' ?>>Neutral</option>
                    <option value="M" <?php echo isset($gender) && $gender === 'M' ? 'selected': '' ?>>Male</option>
                    <option value="F" <?php echo isset($gender) && $gender === 'F' ? 'selected': '' ?>>Female</option>
                </select>
            </div>
            <div class="form-group">
                <label>Email*</label>
                <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
            </div>
            <div class="form-group">
                <label>Phone*</label>
                <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
            </div>
            <div class="form-group">
                <label>Avatar URL*</label>
                <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : '' ?>">
            </div>
            <div class="form-group">
                <label>Deck name*</label>
                <input class="form-control" name="deckname" value="<?php echo isset($deckname) ? $deckname : '' ?>" >
            </div>
            <div class="form-group">
                <label>Number of cards*</label>
                <input class="form-control" name="cards" type="number"  value="<?php echo isset($cards) ? $cards : '' ?>" >
            </div>
            <div class="clear"></div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
</main>

<?php include './includes/footer.php'; ?>