<?php include "./includes/header.php";?>
<?php
    $errors = [];
    if (!empty($_POST)){
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $avatar = $_POST['avatar'];

    if(strlen($name)<3){
        array_push($errors,'Invalid name');
    }
    if(!in_array($gender,["m","f","o"])){
        array_push($errors,'Invalid gender');
    }

    if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
        array_push($errors,'Invalid email');
    }

    if (!preg_match('/^\+?\d{9,}$/',$phone)){
        array_push($errors,'Invalid phone number');
    }

    if (!filter_var($avatar,FILTER_VALIDATE_URL)){
        array_push($errors,'Invalid avatar link');
    }

    if (!count($errors)){
        header('Location: ./registration_successful.php');
        exit();
    }
}
?>

<div class="main">
    <form class="form-signup" method="POST" action=".">
        <?php foreach ($errors as $error):?>
            <div class="error"><?php echo($error)?></div>
            <?php endforeach; ?>
        <div class="form-group">
            <label for="name">Name*</label>
            <input class="form-control" name="name" required value=<?php echo (isset($name) ? $name : "")?>>
        </div>
        <div class="form-group">
            <label for="gender">Gender*</label>
            <select class="form-control" name="gender">
                <option <?php echo(isset($gender)&& $gender==="m" ? "selected" : "")?> value="m">Male</option>
                <option <?php echo(isset($gender)&& $gender==="f" ? "selected" : "")?>value="f">Female</option>
                <option <?php echo(isset($gender)&& $gender==="o" ? "selected" : "")?>value="o">Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="email">Email*</label>
            <input class="form-control" name="email" required type="email" value=<?php echo (isset($email) ? $email : "")?>>
        </div>
        <div class="form-group">
            <label for="phone">Phone*</label>
            <input class="form-control" name="phone" required pattern="\+?\d{9,}" value=<?php echo (isset($phone) ? $phone : "")?>>
        </div>
        <div class="form-group">
            <label for="avatar">Avatar URL*</label>
            <input class="form-control" name="avatar" required value=<?php echo (isset($avatar) ? $avatar : "")?>>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>

</div>
<?php include "./includes/footer.php";?>
