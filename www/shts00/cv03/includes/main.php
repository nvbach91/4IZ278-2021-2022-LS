<?php 
    $errors = [];
    if(!empty($_POST))
    {
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $avatar = $_POST['avatar'];
        $card_deck = $_POST['card_deck'];
        $card_count = $_POST['card_count'];

        if(strlen($name) < 3) {
            array_push($errors, 'Unvalid name, enter at least 3 characters');
        }

        if(!in_array($gender, ['N', 'F', 'M'])) {
            array_push($errors, 'Value is not in gender enum');
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, 'Unvalid email');
        }


        if(!filter_var($avatar, FILTER_VALIDATE_URL)) {
            array_push($errors, 'Unvalid URL');
        }

        if (strlen($card_deck) < 3) {
            array_push($errors, "Unvalid card deck name, enter at least 3 characters");
        }

        if (!is_numeric($card_count)) {
            array_push($errors, "Enter a valid number of cards");
        }

        if(!count($errors)) 
        {
            header('Location: ./registration-success.php');
            exit();
        }
    }  
?>

<main>
    <form action="." method="POST">

    <div>
        <label for="name">Type you name</label>
        <input value="<?php echo isset($name) ? $name : ''; ?>" name="name" pattern="\w{3,}">
    </div>

    <div>
        <label for="gender">Select your gender</label>
        <select name="gender" id="">
            <option <?php echo isset($gender) && $gender == 'M' ? 'selected' : ''; ?> value="M">Male</option>
            <option <?php echo isset($gender) && $gender == 'F' ? 'selected' : ''; ?> value="F">Female</option>
            <option <?php echo isset($gender) && $gender == 'N' ? 'selected' : ''; ?> value="N">Neutral</option>
        </select>
    </div>

    <div>
        <label for="email">Your email*</label>
        <input value="<?php echo isset($email) ? $email : ''; ?>" name="email" type="email">
    </div>

    <div>
        <label for="phone">Your phone*</label>
        <input value="<?php echo isset($phone) ? $phone : ''; ?>" name="phone" pattern="\+?\d{9,}">
    </div>

    <div>
        <label for="avatar">Your avatar URL*</label>
        <input value="<?php echo isset($avatar) ? $avatar : ''; ?>" name="avatar">
    </div>

    <div>
        <label for="card_deck">Your card deck name</label>
        <input value="<?php echo isset($card_deck) ? $card_deck : ''; ?>" name="card_deck">
    </div>

    <div>
        <label for="card_count">Enter cards count</label>
        <input value="<?php echo isset($card_count) ? $card_count : ''; ?>" name="card_count">
    </div>
    <input type="submit" value="Submit">
    </form>

    <?php foreach($errors as $error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endforeach; ?>
</main>