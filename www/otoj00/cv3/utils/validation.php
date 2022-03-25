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
    if (!isset($_POST["name"]) || "" === $name = $_POST["name"]) {
        echo "Name is not filled out<br>";
    } else
        setcookie("name", $name, strtotime('+1 days'));

    if (!isset($_POST["gender"]) || "" === $gender = $_POST["gender"])
        echo "Gender is not filled out<br>";
    else
        setcookie("gender", $gender, strtotime('+1 days'));


    if (!isset($_POST["email"]) || "" === $email = $_POST["email"])
        echo "Email is not filled out<br>";
    elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false)
        echo "Email is invalid<br>";
    else
        setcookie("email", $email, strtotime('+1 days'));

    if (!isset($_POST["phone"]) || "" === $phone = $_POST["phone"])
        echo "Phone is not filled out<br>";
    elseif (!preg_match("/^\+[0-9]{3}\s*[0-9]{3}\s*[0-9]{3}\s*[0-9]{3}$/", $phone))
        echo "Phone is invalid<br>";
    else
        setcookie("phone", $phone, strtotime('+1 days'));

    if (!isset($_POST["avatar"]) || "" === $avatar = $_POST["avatar"])
        echo "Avatar URL is not filled out<br>";
    elseif (filter_var($avatar, FILTER_VALIDATE_URL) === false)
        echo "Avatar URL is invalid<br>";
    else
        setcookie("avatar", $avatar, strtotime('+1 days'));

    // Optional args
    if (isset($_POST["cpack"]) && "" !== $cpack = $_POST["cpack"])
        setcookie("cpack", $cpack, strtotime('+1 days'));

    if (isset($_POST["n_cards"]) && "" !== $n_cards = $_POST["n_cards"])
        setcookie("n_cards", $n_cards, strtotime('+1 days'));


    if (isset($_COOKIE["name"]) && isset($_COOKIE['gender']) && isset($_COOKIE["email"]) && isset($_COOKIE["phone"]) && isset($_COOKIE["avatar"]))
        return true;

    return false;
}
