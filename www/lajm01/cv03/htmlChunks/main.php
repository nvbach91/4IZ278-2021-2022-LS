<main>
    <?php

    $name = "";
    $gender = "";
    $email = "";
    $phone = "";
    $avatar = "";
    $deck_name = "";
    $card_count = "";
    $register_success = false;

    $error_array = [];
    if(!empty($_POST)){
        $name = $_POST["name"];
        $gender = $_POST["gender"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $avatar = $_POST["avatar"];
        $deck_name = $_POST["deck_name"];
        $card_count = $_POST["card_count"];

        if(strlen($name) < 3){
            array_push($error_array, "Name must be at least 3chars long.");
        }

        if(!in_array($gender, ["M", "F", "N"])){
            array_push($error_array, "Unrecognized gender.");
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($error_array, "Not valid email.");
        }

        if(!preg_match("/\+?([0-9]{3})-?([0-9]{3})-?([0-9]{3})-?([0-9]{3})/", $phone)){
            array_push($error_array, "Not valid phone.");
        }

        if(!filter_var($avatar, FILTER_VALIDATE_URL)){
            array_push($error_array, "Not URL");
        }

        if(strlen($deck_name) < 3){
            array_push($error_array, "Deck name must be at least 3 chars long.");
        }

        if(!is_numeric($card_count)){
            array_push($error_array, "Card count must be numeric.");
        }

        if(count($error_array) == 0){
            $register_success = true;
        }
    }
    
    ?>
    <form action="." method="POST">
        <div class="errors">
            <?php 
            foreach($error_array as $error){
                echo '<p>'.$error.'</p>';
            }
            ?>
        </div>
        <div class="success">
            <?php echo $register_success ? "Registration was successfull" : "" ?>
        </div>
        <div>
            <label for="name">* Name:</label>
            <input value="<?php echo $name ?>" name="name">
        </div>
        <div>
            <label for="gender">* Gender:</label>
            <select name="gender">
                <option <?php echo $gender == "M" ? "selected" : "" ?> value="M">M</option>
                <option <?php echo $gender == "F" ? "selected" : "" ?>  value="F">F</option>
                <option <?php echo $gender == "N" ? "selected" : "" ?>  value="N">N</option>
            </select>
        </div>
        <div>
            <label for="email">* Email:</label>
            <input value="<?php echo $email ?>" name="email">
        </div>
        <div>
            <label for="phone">* Phone:</label>
            <input value="<?php echo $phone ?>" name="phone">
        </div>
        <div>
            <label for="avatar">* Avatar:</label>
            <input value="<?php echo $avatar ?>" name="avatar">
        </div>
        <div>
            <?php echo $avatar != "" ? "<img src='".$avatar."'" : ""?>
        </div>
        <div>
            <label for="deck_name">* Deck name:</label>
            <input value="<?php echo $deck_name ?>" name="deck_name">
        </div>
        <div>
            <label for="card_count">* Card count:</label>
            <input value="<?php echo $card_count ?>" name="card_count" type="number">
        </div>
        <input type="submit" value="odeslat">
    </form>
</main>
