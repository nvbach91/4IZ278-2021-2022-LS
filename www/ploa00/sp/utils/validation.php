<?php

require __DIR__ . '/validation-operations.php';

class Validate implements ValidateCredentials
{
  public function name($name)
  {
    if ($name === null) return '';

    if (strlen($name) < 3) {
      return 'Jméno je příliš krátké';
    }
    return '';
  }

  public function surname($surname)
  {
    if ($surname === null) return '';

    if (strlen($surname) < 3) {
      return 'Příjmení je příliš krátké';
    }
    return '';
  }


  public function password($password)
  {
    if ($password === null) return '';

    switch (true) {
      case (strlen($password) < 8):
        return 'Heslo je příliš krátké';
        break;
      case (preg_match('/\s/', $password)):
        return 'Mezery nejsou povoleny';
        break;
      case (!preg_match('/\d/', $password)):
        return 'Číslo je povinné';
        break;
      case (!preg_match('/[a-z]/', $password)):
        return 'Je vyžadováno psaní malých písmen';
        break;
      case (!preg_match('/[A-Z]/', $password)):
        return 'Je vyžadováno psaní velkých písmen';
        break;
      default:
        return '';
    }
  }


  public function email($email)
  {
    if ($email === null) return '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return 'Neplatný formát e-mailu';
    }
    return '';
  }

  public function phone($phone)
  {
    if (!preg_match('/^(\+?420)?(2[0-9]{2}|3[0-9]{2}|4[0-9]{2}|5[0-9]{2}|72[0-9]|73[0-9]|77[0-9]|60[1-8]|56[0-9]|70[2-5]|79[0-9])[0-9]{3}[0-9]{3}$/', $phone)) {
      echo "Neplatné telefonní číslo";
    }
  }

  public function category($category)
  {
    if ($category === null) return '';

    require_once __DIR__ . '/../db/categories-db.php';

    $categoryDB = new CategoryDB();
    $categoryInDB = $categoryDB->fetchByName($category);
    if ($categoryInDB == '') {
      return 'Cateogry is invalid';
    }
    return '';
  }


  public function image($imageUrl)
  {
    if ($imageUrl === null) return '';

    if (!filter_var($imageUrl, FILTER_VALIDATE_URL)) {
      return 'Image URL is invalid';
    }
    return '';
  }

  public function address($address)
  {
    if ($address === null) return '';

    if (!preg_match('/^(?:\\d+ [a-zA-Z ]+, ){2}[a-zA-Z ]+$/', $address)) {
      return ' Adress is invalid';
    }
    return '';
  }
}
