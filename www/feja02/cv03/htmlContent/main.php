<main>

    <?php
        $name = "";
        $gender = "";
        $email = "";
        $phone = "";
        $avatar = "";
        $deck_name = "";
        $card_count = "";
        $registered = false;

        $errorList = [];
        if (!empty($_POST)) {
            $name = $_POST["name"];
            $gender = $_POST["gender"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $avatar = $_POST["avatar"];
            $deck_name = $_POST["deck_name"];
            $card_count = $_POST["card_count"];

            if (strlen($name) < 6) {
                array_push($errorList, "Name must be at least 6 chars long");
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errorList, "Invalid email address");
            }

            if (!preg_match('/^[0-9]{9}+$/', $phone)) {
                array_push($errorList, "Invalid phone number");
            }

            if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
                array_push($errorList, "Invalid avatar URL");
            }

            if (strlen($deck_name) < 6) {
                array_push($errorList, "Deck name must be at least 6 chars long");
            }

            if (!is_numeric($card_count)) {
                array_push($errorList, "Card number must be numeric");
            }

            if (empty($errorList)) {
                $registered = true;
            }
        }
    ?>

    <div class="form">
        <div class="form-status" style="background-color: rgb(255, 55, 55)">
            <?php
                foreach ($errorList as $error) {
                    echo "<p>" . $error . "</p>";
                }
            ?>
        </div>
        <div class="form-avatar">
            <?php echo ($registered && $avatar != "") ? '<img src="' . $avatar . '" width=100px />' : ''; ?>
        </div>
        <div class="form-input">
            <form action="." method="POST">
                <div class="form-input-name">
                    <input value="<?php echo $name; ?>" name="name" type="text" placeholder="full name">
                </div>
                <div class="form-input-gender">
                    <input value="<?php echo $gender; ?>" name="gender" type="text" placeholder="gender">
                </div>
                <div class="form-input-email">
                    <input value="<?php echo $email; ?>" name="email" type="text" placeholder="email address">
                </div>
                <div class="form-input-phone">
                    <input value="<?php echo $phone; ?>" name="phone" type="text" placeholder="phone">
                </div>
                <div class="form-input-avatar">
                    <input value="<?php echo $avatar; ?>" name="avatar" type="text" placeholder="avatar url">
                </div>
                <div class="form-input-deck_name">
                    <input value="<?php echo $deck_name; ?>" name="deck_name" type="text" placeholder="deck name">
                </div>
                <div class="form-input-card_count">
                    <input value="<?php echo $card_count; ?>" name="card_count" type="text" placeholder="card count">
                </div>
                <input type="submit" value="&#10004;">
            </form>
        </div>
    </div>
</main>