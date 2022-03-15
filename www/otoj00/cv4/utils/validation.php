<?php


/**
 * Validates entries from POST
 *
 * Returns True if everything ok
 * @return  bool
 */
function process_entries(): bool
{
    if (empty($_POST))
        return false;

    session_start();

    validate_name();
    validate_gender();
    validate_email();
    validate_phone();
    validate_avatar();
    validate_password();

    // Optional args
    if (isset($_POST["cpack"]) && "" !== $cpack = $_POST["cpack"])
        setcookie("cpack", $cpack, strtotime('+1 days'));

    if (isset($_POST["n_cards"]) && "" !== $n_cards = $_POST["n_cards"])
        setcookie("n_cards", $n_cards, strtotime('+1 days'));


    if (isset($_COOKIE["name"]) && isset($_COOKIE['gender']) && isset($_COOKIE["email"]) && isset($_COOKIE["phone"]) && isset($_COOKIE["avatar"]))
        return true;

    return false;
}

/**
 * @return bool
 */
function validate_avatar(): bool
{
    if (!isset($_POST["avatar"]) || "" === $avatar = $_POST["avatar"]) {
        echo "Avatar URL is not filled out<br>";
        return false;
    } elseif (filter_var($avatar, FILTER_VALIDATE_URL) === false) {
        echo "Avatar URL is invalid<br>";
        return false;
    } else
        setcookie("avatar", $avatar, strtotime('+1 days'));
    return true;
}

/**
 * @return bool
 */
function validate_phone(): bool
{
    if (!isset($_POST["phone"]) || "" === $phone = $_POST["phone"]) {
        echo "Phone is not filled out<br>";
        return false;
    } elseif (!preg_match("/^\+[0-9]{3}\s*[0-9]{3}\s*[0-9]{3}\s*[0-9]{3}$/", $phone)) {
        echo "Phone is invalid<br>";
        return false;
    } else
        setcookie("phone", $phone, strtotime('+1 days'));
    return true;
}

/**
 * @return bool
 */
function validate_email(): bool
{
    if (!isset($_POST["email"]) || "" === $email = $_POST["email"]) {
        echo "Email is not filled out<br>";
        return false;
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo "Email is invalid<br>";
        return false;
    } else
        setcookie("email", $email, strtotime('+1 days'));
    return true;
}

/**
 * @return bool
 */
function validate_gender(): bool
{
    if (!isset($_POST["gender"]) || "" === $gender = $_POST["gender"]) {
        echo "Gender is not filled out<br>";
        return false;
    } else
        setcookie("gender", $gender, strtotime('+1 days'));
    return true;
}

/**
 * @return bool
 */
function validate_name(): bool
{
    if (!isset($_POST["name"]) || "" === $name = $_POST["name"]) {
        echo "Name is not filled out<br>";
        return false;
    } else
        setcookie("name", $name, strtotime('+1 days'));
    return true;
}


/**
 * @return bool
 */
function validate_password(): bool
{
    if (!isset($_POST["password"]) || "" === $_POST["password"] || strlen($_POST["password"]) < 4) {
        echo "Password is not filled out<br>";
        return false;
    }
    return true;
}