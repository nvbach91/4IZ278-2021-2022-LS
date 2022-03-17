<?php require './utils/utils.php';?>

<?php
$path= './';
$errors=[];

if(!empty($_POST)){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

    if (strlen($name) < 3 ) {
        array_push($errors, 'The name is not a valid name');
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        array_push($errors, 'Invalid email');
    }

    if($password !== $passwordConfirm){
        array_push($errors, 'Passwords are not same.');
    }

    if(strlen($password)<8){
        array_push($errors, 'Password is short, use at least 8 characters.');
    }

    if(fetchUser($email)){
        array_push($errors,"User $email already registered. Try again");
    }


    if(!count($errors)) {
        registerNewUser($name,$email,$password);
        header("Location: login.php?ref=registration&email=$email");
        exit();
    }

}
?>
<?php include './includes/head.php';?>

<main>

    <h1>Registration form</h1>

    <form method="POST" action="./registration.php">
        <div class="errors">    
        <?php foreach($errors as $error):?>
            <div class="error"><?php echo $error; ?></div>
        <?php endforeach;?>
        </div>
        <div class="form-group">
            <label for="name">Type your name</label>
            <input value="<?php echo isset($name) ? $name : '';?>" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Your email</label>
            <input type="email" value="<?php echo isset($email)? $email : '';?>" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" value="<?php echo @$password; ?>" required>
        </div>
        <div class="form-group">
            <label for="passwordConfirm">Confirm Password</label>
            <input type="password" name="passwordConfirm" value="<?php echo @$passwordConfirm; ?>" required>
        </div>
        <button class="button">Submit</button>
        
    </form>
    <a href="./index.php"><button class="button-return">Go back</button></a>

</main>

<?php include './includes/foot.php';?>
