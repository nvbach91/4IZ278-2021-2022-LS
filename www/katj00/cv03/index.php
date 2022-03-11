<?php
require("header.php");


$error_array = [];
if (!empty($_POST)) {

    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $avatar = $_POST['avatar'];
    $package = $_POST['package'];
    $numCards = $_POST['numCards'];

    if (count_chars($name) < 3) {
        array_push($error_array, "Name must be at least 3 chars long.");
    }

    if (!in_array($gender, ["M", "F", "N"])) {
        array_push($error_array, "Unrecognized gender.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($error_array, "Not valid email.");
    }

    if (!preg_match("/^\+[0-9]{3}[0-9]{9}$/", $phone)) {
        array_push($error_array, "Not valid phone.");
    }

    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($error_array, "Not URL");
    }

    if (count_chars($package) < 3) {
        array_push($error_array, "Package name must be at least 3 chars long");
    }

    if ($numCards < 12) {
        array_push($error_array, "Number of cards in package must be at least 12");
    }
}
?>
<main class="container">
    <?php
    if (!empty($_POST) && count($error_array) == 0) {
        echo "Registrace byla úspěšná";
    }
    foreach ($error_array as $error) {
        ?>
        <p><?php echo $error ?></p>
        <?php
    }
    ?>
    <form action="." method="POST">
        <div class="form_field">
            <label for="name">
                Full name:
            </label>
            <div class="form-field__input">
                <input id="name" name="name" type="text" value="<?php echo $email ?? '' ?>" autocomplete="name"
                       required>
            </div>
        </div>
        <div class="form-field">
            <label for="gender">
                Gender
            </label>
            <div class="form-field__input">
                <select id="gender" name="gender" autocomplete="gender" required>
                    <option <?php echo isset($gender) && $gender === 'N' ? 'selected' : '' ?> value="N">Neutral</option>
                    <option <?php echo isset($gender) && $gender === 'M' ? 'selected' : '' ?> value="M">Male</option>
                    <option <?php echo isset($gender) && $gender === 'F' ? 'selected' : '' ?> value="F">Female</option>
                </select>
            </div>
        </div>
        <div class="form-field">
            <label for="email">
                Email:
            </label>
            <div class="form-field__input">
                <input id="email" name="email" value="<?php echo $email ?? '' ?>" type="email" autocomplete="email"
                       required>
            </div>
        </div>
        <div class="form-field">
            <label for="phone">
                Phone:
            </label>
            <div class="form-field__input">
                <input id="phone" name="phone" value="<?php echo $phone ?? '' ?>" type="tel" autocomplete="tel"
                       required>
            </div>
        </div>
        <div class="form-field">
            <label for="avatar">
                Avatar URL:
            </label>
            <?php
            if ($avatar) {
                ?>
                <img src="<?php echo $avatar; ?>" alt="">
                <?php
            }
            ?>
            <div class="form-field__input">
                <input id="avatar" name="avatar" value="<?php echo $avatar ?? '' ?>" type="url" required>
            </div>
        </div>
        <div class="form-field">
            <label for="package">
                Package name:
            </label>
            <div class="form-field__input">

                <input id="package" name="package" value="<?php echo $package ?? '' ?>" type="text" required>
            </div>
        </div>
        <div class="form-field">
            <label for="num_cards">
                Amount of cards:
            </label>
            <div class="form-field__input">
                <input id="num_cards" name="numCards" value="<?php echo $numCards ?? 12 ?>" type="number" required>
            </div>
        </div>
        <button type="submit">Send form</button>
    </form>
</main>
<?php require("footer.php"); ?>
