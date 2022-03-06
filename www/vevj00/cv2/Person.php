<?php

class Person
{
  private $name;
  private $birthDate;
  private $posision;
  private $contact;
  private $webAddress;

  function __construct($name, $birthDate, $posision, $contact, $webAddress)
  {
    $this->name = $name;
    $this->birthDate = $birthDate;
    $this->posision = $posision;
    $this->contact = $contact;
    $this->webAddress = $webAddress;
  }

  function getPosision()
  {
    return $this->posision;
  }


  function getName()
  {
    return $this->name;
  }

  function getAge()
  {
    return floor((time() - strtotime($this->birthDate)) / 31556926);
  }

  function getContact()
  {
    return $this->contact;
  }

  function getWebAddress()
  {
    return $this->webAddress;
  }


}

?> 