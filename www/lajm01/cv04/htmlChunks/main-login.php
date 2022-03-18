<main>
    <?php
    session_start();
    $registered_string = "";
    $email = "";
    if(isset($_SESSION["registered"])){
        $email = $_SESSION["registered"];
        unset($_SESSION["registered"]);
        $registered_string = "You are now registered";
    }

    require("php/dbHelper.php");

    $login_result = null;

    $error_array = [];
    if(!empty($_POST)){
        $email = $_POST["email"];
        $password = $_POST["password"];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            array_push($error_array, "Not valid email.");
        }

        if(strlen($password) < 3){
            array_push($error_array, "Password must be at least 3chars long.");
        }

        if(count($error_array) == 0){
            $helper = new DBHelper();
            
            $login_result = $helper->tryLogin($email, $password);
            if($login_result !== true){
                array_push($error_array, $login_result);
            }
        }
    }
    ?>

    <form action="login.php" method="POST">
        <div class="errors">
            <?php 
                foreach($error_array as $error){
                    echo '<p>'.$error.'</p>';
                }
            ?>
        </div>
        <div class="success">
            <?php echo $registered_string ?>
            <?php echo ($login_result === true) ? "You are now logged in" : "" ?>
        </div>
        <div>
            <label for="email">* Email:</label>
            <input value="<?php echo $email ?>" name="email">
        </div>
        <div>
            <label for="password">* Password:</label>
            <!-- dont -->
            <input value="" name="password" type="password">
        </div>
        <!-- <div>
            <label for="capcha">Capcha:</label>
            <input value="" name="capcha">
        </div> -->
        <input type="submit" value="odeslat">
    </form>
</main>
