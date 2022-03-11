<?php include './includes/head.php'; ?>

<?php
//var_dump($_POST);
$errors = [];

if (!empty($_POST)) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $avatar = $_POST['avatar'];
    $deck = $_POST['deck'];
    $deckCount = $_POST['count'];

    //echo $avatar;

    if (strlen($name) < 3) {
        array_push($errors, '*The name is too short');
    }

    if (!in_array($gender, ['F', 'M', 'O'])) {
        array_push($errors, '*Select a gender from the list');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, '*Invalid Email');
    }

    if (!preg_match('/^(\+\d{3} ?)?(\d{3} ?){3}$/', $phone)) {
        array_push($errors, '*Invalid Phone number');
    }

    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($errors, '*Invalid Avatar URL');
    }

    if (strlen($deck) < 3) {
        array_push($errors, '*Invalid deck name');
    }

    if (!preg_match('/^([1-9][0-9]{0,2})$/', $deckCount)) {
        array_push($errors, '*Please specify the number of cards');
    }

    if (!count($errors)) {
        $alertStatus = 'success';
        //header('Location: ./registration-success.php', false);
        //exit();
    }
}
?>
<?php if (isset($alertStatus)) : ?>
   <div class="reg-success">You have successfully registered for the card tournament!</div>
<?php endif; ?>
<h1>PHP Registration form</h1>
<main>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="error-container">
            <?php foreach ($errors as $error) : ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endforeach; ?>
        </div>
        <div>
            <label for="name">Type your name</label>
            <input value="<?php echo isset($name) ? $name : '' ?>" name="name" required>
            <small class="decription">Example: John</small>
        </div>
        <div>
            <label for="gender">Select your gender</label>
            <select name="gender">
                <option <?php echo isset($gender) && $gender === 'S' ? 'selected' : ''; ?> value="S">- select -</option>
                <option <?php echo isset($gender) && $gender === 'F' ? 'selected' : ''; ?> value="F">Female</option>
                <option <?php echo isset($gender) && $gender === 'M' ? 'selected' : ''; ?> value="M">Male</option>
                <option <?php echo isset($gender) && $gender === 'O' ? 'selected' : ''; ?> value="O">Other</option>
            </select>
        </div>
        <div>
            <label for="email">Your email<span class="mandatory">*</span></label>
            <input value="<?php echo isset($email) ? $email : '' ?>" name="email" required type="email">
            <small class="decription">Example: example@example.com</small>
        </div>
        <div>
            <label for="phone">Your phone number<span class="mandatory">*</span></label>
            <input value="<?php echo isset($phone) ? $phone : '' ?>" name="phone" required>
            <small class="decription">Example: +000 000 000 000</small>
        </div>
        <div>
            <label for="avatar">URL of avatar<span class="mandatory">*</span></label>
            <input value="<?php echo isset($avatar) ? $avatar : '' ?>" name="avatar" required>
            <small class="decription">Example: https://www.example.com/</small>
            <?php if (isset($avatar)) : ?>
                <img src="<?php echo $avatar; ?>" alt="avatar">
            <?php endif; ?>
        </div>
        <div>
            <label for="deck">Deck name<span class="mandatory">*</span></label>
            <input value="<?php echo isset($deck) ? $deck : '' ?>" name="deck" required>
        </div>
        <div>
            <label for="count">Number of cards in the deck<span class="mandatory">*</span></label>
            <input type="number" value="<?php echo isset($deckCount) ? $deckCount : '' ?>" name="count" min="0">
        </div>
        <button>Submit</button>
    </form>
</main>

<?php include './includes/foot.php'; ?>