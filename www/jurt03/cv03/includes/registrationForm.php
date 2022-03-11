<?php

$errors=[];

if(!empty($_POST)){
$name = $_POST['name'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$avatar = $_POST['avatar'];
$deckName = $_POST['deckName'];
$numberOfCards = $_POST['numberOfCards'];

if (strlen($name) < 3 ) {
    
    array_push($errors, 'The name is not a valid name');
}

if (strlen($deckName) < 3 ) {

    array_push($errors, 'The deckname is not a valid name');
}

if(!in_array($gender, ['N','F','M'])){
    
    array_push($errors, 'The gender is not valid');
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    
    array_push($errors, 'Invalid email');
}

if(!filter_var($avatar, FILTER_VALIDATE_URL)){
    
    array_push($errors, 'Invalid URL');
}

if(!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/',$phone)){
    array_push($errors, 'Invalid phone number');
}

if($numberOfCards <= 0){
    array_push($errors, 'Invalid card count');
}

if(!count($errors)) {
   $success=true;    
}

}
?>


<h1>Formulář pro registraci hráče</h1>
<?php if (isset($success)) : ?>
    <div class="success">
        <p>Congratulations! You have successfully signed up!</p>
    </div>
<?php endif; ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div id="alerts">
        <?php foreach($errors as $error):?>
            <div class="error"><?php echo $error; ?></div>
        <?php endforeach; 
        if (count($errors)) : echo '<style type="text/css">
                                    #alerts {
                                        display: block;
                                            }
                                    </style>';
        endif;?>
        </div>
        <div class="form-group">
            <label for="name">Type your name</label>
            <input value="<?php echo isset($name) ? $name : '';?>" name="name" >
        </div>
        <div class="form-group">
            <label for="">Select your gender</label>
            <select name="gender">
                <option value="N" <?php echo isset($gender) && $gender === 'N' ? 'selected' : ''; ?>>Neutral</option>
                <option value="M" <?php echo isset($gender) && $gender === 'M' ? 'selected' : ''; ?>>Male</option>
                <option value="F" <?php echo isset($gender) && $gender === 'F' ? 'selected' : ''; ?>>Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Your email</label>
            <input value="<?php echo isset($email)? $email : '';?>" name="email">
        </div>
        <div class="form-group">
            <label for="phone">Your phone number</label>
            <input value="<?php echo isset($phone)? $phone : '';?>" name="phone" >
        </div>
        <div class="form-group">
            <label for="avatar">Avatar URL*</label>
            <input value="<?php echo isset($avatar)? $avatar : '';?>" name="avatar" >
        </div>
        <div class="form-group">
            <label for="deckName">Deck name</label>
            <input value="<?php echo isset($deckName) ? $deckName : '';?>" name="deckName" >
        </div>
        <div class="form-group">
            <label for="numberOfCards">Number of cards</label>
            <input value="<?php echo isset($numberOfCards) ? $numberOfCards : '';?>" name="numberOfCards" type="number" >
        </div>
        <button class="button">Submit</button>
        


        <?php if (isset($avatar) && strlen($avatar)) : ?> 
            <div id="avatar">
        <img src="<?php echo $avatar; ?>" alt="image of avatar">
        </div>
          <?php endif; ?>
        
        
        
    </form>
    