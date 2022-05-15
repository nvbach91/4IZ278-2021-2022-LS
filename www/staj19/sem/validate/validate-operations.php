<?php

interface ValidateCredentials
{
  // validate name
  public function name($name);

  // validate password
  public function password($password);

  // validate email
  public function email($email);

  // validate privilege
  public function privilege($privilege);

  // validate datetime
  public function datetime($datetime);

  // validate category
  public function category($category);

  // validate image - if URL is correct
  public function image($imageUrl);

  // validate capacity
  public function capacity($capacity);

  // validate street
  public function street($street);

  // validate city
  public function city($city);

  // validate zip
  public function zip($zip);

  // validate location
  public function location($street, $city, $zip);
}
