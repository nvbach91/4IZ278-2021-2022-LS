<?php include './includes/header.php'; ?>
<?php

$name = "";
$gender = "";
$email = "";
$phone = "";
$avatar = "";
$deckName = "";
$cardCount = "";
$register_success = false;

$error_list = [];

if (!empty($_POST)) {
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $avatar = $_POST["avatar"];
    $deckName = $_POST["deckName"];
    $cardNumber = $_POST["cardNumber"];

    if (!$name) {
        array_push($error_list, "Name is empty");
    }

    if (!$email) {
        array_push($error_list, "Email is empty");
    }

    if (!$phone) {
        array_push($error_list, "Phone is empty");
    }

    if (!$avatar) {
        array_push($error_list, "Avatar URL is empty");
    }

    if (!$deckName) {
        array_push($error_list, "Your deck name is empty");
    }

    if (!$cardNumber) {
        array_push($error_list, "Number of cards in your deck is empty");
    }

    if (count($error_list) == 0) {
        $register_success = true;
    }
}


?>

<main>
    <h1>Registration form</h1>
    <div class="alert alert-danger">
        <?php foreach ($error_list as $error) : ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>
    <form class="form-signup" method="POST" action=".">
        <div class="success">
            <?php echo $register_success ? "Registration was successfull" : "" ?>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input class="form-control" name="name" type="text" value="<?php echo isset($name) ? $name : '' ?>">
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select name="gender" value="<?php echo isset($gender) ? $gender : '' ?>">
                <option>M</option>
                <option>F</option>
                <option>N</option>
            </select>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
        </div>
        <div class="form-group">
            <label>Phone:</label>
            <input class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>">
        </div>
        <div class="form-group">
            <label>Avatar URL:</label>
            <input class="form-control" name="avatar" value="<?php echo isset($avatar) ? $avatar : '' ?>">
        </div>
        <div class="form-group">
            <label>Your deck name:</label>
            <input class="form-control" name="deckName" type="text" value="<?php echo isset($deckName) ? $deckName : '' ?>">
        </div>
        <div class="form-group">
            <label>Number of cards in your deck:</label>
            <input class="form-control" name="cardNumber" type="text" value="<?php echo isset($cardNumber) ? $cardNumber : '' ?>">
        </div>
        <div>
            <?php echo $avatar != "" ? "<img src='" . $avatar . "'" : "" ?>
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
</main>

<?php include './includes/footer.php'; ?>