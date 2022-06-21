<?php

interface ValidateCredentials
{
  public function name($name);

  public function surname($surname);

  public function password($password);

  public function email($email);

  public function image($imageUrl);

  public function address($address);
}
