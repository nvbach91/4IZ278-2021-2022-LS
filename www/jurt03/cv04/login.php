<?php require ('./utils/utils.php');?>

<?php 
$errors=[];
$path='./';

if(isset($_GET['email'])){
    $email = $_GET['email'];
}

if(!empty($_POST)){
    $email = $_POST['email'];
    $password = $_POST['password'];


    $users = fetchUsers();

    if(!count($errors)){
        $authentication = authenticate($email,$password);
            if(is_string($authentication)){
                array_push($errors, $authentication);
            } else {
                header("Location: ./profile.php?email=$email");
            exit();
            }
    }
}

?>
<?php include ('./includes/head.php');?>

<main>
    <h1>Login</h1>
    <form method="POST">
        <?php if (isset($_GET['email']) && @$_GET['ref'] === 'registration'): ?>
            <div class="success">You have signed up sucesfully</div>
        <?php endif;?>
        <div class="errors">
            <?php foreach($errors as $error):?>
                <div class="error"><?php echo $error; ?></div>
            <?php endforeach;?>
        </div>
        <div class="form-group">
            <label for="email">Your email</label>
            <input type="email" value="<?php echo isset($email)? $email : '';?>" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" value="<?php echo isset($password)? $password : '';?>" required>
        </div>
        <button class="button">Log in</button>
    </form>
    <a href="./index.php"><button class="button-return">Go back</button></a>
</main>

<?php include ('./includes/foot.php');?>