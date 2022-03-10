<?php
function validateForm(): array {

    $validation = [];
    $validation['errors'] = [];
    $validation['data'] = [];

    if (empty($_POST)) {
        return $validation;
    }

    $validation['data']['name'] = $_POST['name'] ?? null;
    if (empty($_POST['name']) || strlen(trim($_POST['name'])) === 0) {
        $validation['errors'][] = 'name';
    }

    $validation['data']['email'] = $_POST['email'] ?? null;
    if (empty($_POST['email']) || strlen(trim($_POST['name'])) === 0 || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $validation['errors'][] = 'email';
    }

    $validation['data']['gender'] = $_POST['gender'] ?? null;
    if (empty($_POST['gender']) || !in_array($_POST['gender'], ['M', 'F', 'O'])) {
        $validation['errors'][] = 'gender';
    }

    $validation['data']['phone'] = $_POST['phone'] ?? null;
    if (empty($_POST['phone']) || preg_match('/^(\+\d{1,2}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/', $_POST['phone']) === false) {
        $validation['errors'][] = 'phone';
    }

    $validation['data']['avatar'] = $_POST['avatar'] ?? null;
    if (empty($_POST['avatar']) || !filter_var($_POST['avatar'], FILTER_VALIDATE_URL)) {
        $validation['errors'][] = 'avatar';
    }

    $validation['data']['deckName'] = $_POST['deckName'] ?? null;
    if (empty($_POST['deckName']) || strlen(trim($_POST['deckName'])) === 0) {
        $validation['errors'][] = 'deck name';
    }

    $validation['data']['cardsInDeck'] = $_POST['cardsInDeck'] ?? null;
    if (empty($_POST['cardsInDeck']) || !is_numeric($_POST['cardsInDeck'])) {
        $validation['errors'][] = 'number of cards in deck';
    }



    return $validation;
}
