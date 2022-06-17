<?php

require __DIR__ . '/validate-operations.php';

class Validate implements ValidateCredentials
{
  public function name($name)
  {
    if ($name === null) return '';

    if (strlen($name) < 3) {
      return 'Name is too short';
    }
    return '';
  }


  public function password($password)
  {
    if ($password === null) return '';

    switch (true) {
      case (strlen($password) < 8):
        return 'Password is too short';
        break;
      case (preg_match('/\s/', $password)):
        return 'Spaces are not allowed';
        break;
      case (!preg_match('/\d/', $password)):
        return 'Number is required';
        break;
      case (!preg_match('/[a-z]/', $password)):
        return 'Lower-case is required';
        break;
      case (!preg_match('/[A-Z]/', $password)):
        return 'Upper-case is required';
        break;
      default:
        return '';
    }
  }


  public function email($email)
  {
    if ($email === null) return '';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return 'Invalid email format';
    }
    return '';
  }


  public function privilege($privilege)
  {
    if ($privilege === null) return '';

    if (!in_array($privilege, ['1', '2'])) {
      return 'Invalid privilege number';
    }
    return '';
  }


  public function datetime($datetime)
  {
    if ($datetime === null) return '';

    switch (true) {
      case (!isset($datetime)):
        return 'Datetime is required';
        break;
      case (!date($datetime)):
        return 'Incorrect datetime format';
        break;
      case (strtotime($datetime) < time() + 60 * 60):
        return 'Too late to create an event';
        break;
      default:
        return '';
    }
  }


  public function category($category)
  {
    if ($category === null) return '';

    require_once __DIR__ . '/../db/category-db.php';

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


  public function capacity($capacity)
  {
    if ($capacity === null) return '';

    if (!preg_match('/^\d+$/', $capacity)) {
      return 'Capacity is invalid';
    }
    return '';
  }


  public function street($street)
  {
    if ($street === null) return '';

    if (!preg_match('/^([A-z]+ ?)+\d+(\/\d+)?$/', $street)) {
      return 'Street is invalid';
    }
    return '';
  }


  public function city($city)
  {
    if ($city === null) return '';

    if (!preg_match('/^([A-z]+ ?)+$/', $city)) {
      return 'City is invalid';
    }
    return '';
  }


  public function zip($zip)
  {
    if ($zip === null) return '';

    if (!preg_match('/^\d{3} ?\d{2}$/', $zip)) {
      return 'ZIP is invalid';
    }
    return '';
  }

  public function location($street, $city, $zip)
  {
    if (
      (isset($street) || isset($city) || isset($zip))
      && !(isset($street) && isset($city) && isset($zip))
    ) {
      return 'Fill in or leave empty all address inputs';
    }
    return '';
  }
}
