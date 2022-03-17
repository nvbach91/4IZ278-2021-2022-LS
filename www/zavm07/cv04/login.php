<?php
require './includes/header.php';
require './utils.php'; ?>
<?php
    $errors =[];
    if(!empty($_POST)){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = getUsers($email);

        $userLoggedIn = false;
        if(!empty($user)&&$user[3]===$password){
            $userLoggedIn = true;
        }
        else{
            array_push($errors,'Wrong credentials');
        }

        if (!count($errors)){
            header('Location: ./dashboard.php');
            exit();
        }
    }
?>
<main>
    <h1>Login page</h1>
    <?php foreach ($errors as $error):?>
        <div class="error"><?php echo($error)?></div>
    <?php endforeach; ?>
        <form class="login_form" method="post" action="./login.php">
            <div class="form-group">
        <label>Your email: </label>
        <input class="form-control" placeholder="email" name="email" required type="email" value=<?php echo (isset($email) ? $email : "")?>>
            </div>
            <div class="form-group">
        <label>Password: </label>
        <input class="form-control" placeholder="password" name="password" value=<?php echo (isset($password) ? $password : "")?>>
            </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</main>
