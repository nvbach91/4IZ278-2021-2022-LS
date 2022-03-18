<?php
require "utils/validation.php";
if (process_entries()) {
    try {
        mail($_POST["email"], "Card tournament", "You had been successfully registered");
    } catch (Exception $ex) {
    }
    echo "Registration successfull!";
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Card Tournament Signup</title>
        <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    </head>
    <body>
    <h1 class="text-center">Card Tournament Signup</h1>
    <hr>
    <div class="row justify-content-center">
        <form class="form-signup" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label>Name*</label>
                <input class="form-control" name="name"
                       value="<?php if (isset($_POST['name'])) echo $_POST['name']; elseif (isset($_COOKIE['name'])) echo $_COOKIE['name']; ?>">
                <small class="text-muted">Example: Philip Fry</small>
            </div>
            <div class="form-group">
                <label>Gender*</label>
                <select class="form-control" name="gender">
                    <option <?php if (isset($_POST['gender']) && $_POST['gender'] == "N" || isset($_COOKIE['gender']) && $_COOKIE['gender'] == 'N') {
                        echo("selected");
                    } ?> value="N">Neutral
                    </option>
                    <option <?php if (isset($_POST['gender']) && $_POST['gender'] == "F" || isset($_COOKIE['gender']) && $_COOKIE['gender'] == 'F') {
                        echo("selected");
                    } ?> value="F">Female
                    </option>
                    <option <?php if (isset($_POST['gender']) && $_POST['gender'] == "M" || isset($_COOKIE['gender']) && $_COOKIE['gender'] == 'M') {
                        echo("selected");
                    } ?> value="M">Male
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label>Email*</label>
                <input class="form-control" name="email"
                       value="<?php if (isset($_POST['email'])) echo $_POST['email']; elseif (isset($_COOKIE["email"])) echo $_COOKIE["email"]; ?>">
                <small class="text-muted">Example: example@gmail.com</small>
            </div>
            <div class="form-group">
                <label>Phone*</label>
                <input class="form-control" name="phone"
                       value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; elseif (isset($_COOKIE["phone"])) echo $_COOKIE["phone"]; ?>">
                <small class="text-muted">Example: +420 123 123 123</small>
            </div>
            <div class="form-group">
                <label>Avatar URL*</label>
                <input class="form-control" name="avatar"
                       value="<?php if (isset($_POST['avatar'])) echo $_POST['avatar']; elseif (isset($_COOKIE["avatar"])) echo $_COOKIE["avatar"]; ?>">
                <small class="text-muted">Example: https://i.pravatar.cc/150?img=50</small>
            </div>
            <div class="form-group">
                <label>Card Pack</label>
                <input class="form-control" name="cpack"
                       value="<?php if (isset($_POST['cpack'])) echo $_POST['cpack']; elseif (isset($_COOKIE["cpack"])) echo $_COOKIE["cpack"]; ?>">
                <small class="text-muted">Example: Ultra Pack</small>
            </div>
            <div class="form-group">
                <label>Number of Cards in Pack</label>
                <input class="form-control" name="n_cards"
                       value="<?php if (isset($_POST['n_cards'])) echo $_POST['n_cards']; elseif (isset($_COOKIE["n_cards"])) echo $_COOKIE["n_cards"]; ?>">
                <small class="text-muted">Example: 30</small>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </div>
    </body>
    </html>



