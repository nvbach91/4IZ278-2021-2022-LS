<?php

class Company
{
  private $name;
  private $logo;

  function __construct($name, $logo)
  {
    $this->name = $name;
    $this->logo = $logo;
  }

  function getName()
  {
    return $this->name;
  }

  function getLogo($type)
  {
    return $this->logo[$type];
  }
}

?>