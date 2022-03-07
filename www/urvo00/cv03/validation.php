<?php
$errors = [];
if (!empty($_POST)) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $avatar = $_POST['avatar'];
    $deck = $_POST['deck'];
    $cards = $_POST['cards'];

    if (!preg_match("/^[a-zA-Z -.]{2,}$/", $name)) {
        array_push($errors, 'Invalid name');
    }
    if (!in_array($gender, ['N', 'F', 'M'])) {
        array_push($errors, 'Please select a gender');
    }
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Invalid email');
    }
    if (!preg_match("/^\+?\d{9,}$/", $phone)) {
        array_push($errors, 'Invalid phone number');
    }
    if (filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($errors, 'Invalid avatar url');
    }
    if (strlen($deck) < 1) {
        array_push($errors, 'Deck name must be at least 1 character long');
    }
    if ($cards < 1) {
        array_push($errors, 'The number of cards must be greater than 0');
    }
    if (!count($errors)) {
        header('Location: ./registration-success.php');
        exit();
    }
    echo $avatar;
}
?>