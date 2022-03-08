<?php include './includes/head.php'; ?>

<?php
    //var_dump($_POST);

    $errors = [];

    if(!empty($_POST)) {
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $avatar = $_POST['avatar'];
    

    if(strlen($name) < 3 ) {
        // error
        array_push($errors, 'Invalid name');
    }

    if(!in_array($gender, ['N', 'F', 'M'])) {
        // error
        array_push($errors, 'You are a hacker');
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // error
        array_push($errors, 'Invalid email adress');
    }

    if(!preg_match('/\+?\d{0,}/', $phone)) {
        // error
        array_push($errors, 'Invalid phone number');
    }

    if(!filter_var($avatar, FILTER_VALIDATE_URL)) {
        // error
        array_push($errors, 'Invalid avatar URL');
    }

    if (!count($errors)) {
        // zapis do 
        header('Location: ./registration-success.php');
        exit();
    }
    
}
?>


<main>
    <h1>Registration</h1>
    <div class="registration">
        <form class="reg-form" action="." method="POST">
            <div class="panes pane-name">
                <label for="name">Type your name</label><br>
                <input value="<?php echo isset($name) ? $name : '' ?>" name="name"> <!--required pattern="\w{3,}"-->
            </div>
            <div class="panes pane-gender">
                <label for="gender">Select your gender</label><br>
                <select name="gender">
                    <option <?php echo isset($gender) && $gender === 'N' ? 'selected' : ''; ?> value="N">Neutral</option>
                    <option <?php echo isset($gender) && $gender === 'F' ? 'selected' : ''; ?> value="F">Female</option>
                    <option <?php echo isset($gender) && $gender === 'M' ? 'selected' : ''; ?> value="M">Male</option>
                </select>
            </div>
            <div class="panes pane-email">
                <label for="email">*Your email</label><br>
                <input value="<?php echo isset($email) ? $email : '' ?>" name="email" required> <!-- type="email"-->
            </div>
            <div class="panes pane-phone">
                <label for="phone">*Your phone number</label><br>
                <input value="<?php echo isset($phone) ? $phone : '' ?>" name="phone" required> <!--pattern="\+?\d{0,}"-->
            </div>
            <div class="panes pane-avatar">
                <label for="avatar">*Avatar URL</label><br>
                <input value="<?php echo isset($avatar) ? $avatar : '' ?>" name="avatar" required> <!-- type="url"-->
            </div>
            <button>Submit</button>
            <?php foreach($errors as $error): ?>
                <div class="error"> <?php echo $error; ?></div>
            <?php endforeach; ?>
        </form>
    </div>
</main>

<?php include './includes/foot.php'; ?>