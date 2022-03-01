<?php

class Address
{
  private $city;
  private $zip;
  private $street;
  private $descNum;
  private $orienNum;

  function __construct($city, $zip, $street, $descNum, $orienNum)
  {
    $this->city = $city;
    $this->zip = $zip;
    $this->street = $street;
    $this->descNum = $descNum;
    $this->orienNum = $orienNum;
  }

  function getFullStreet()
  {
    return $this->street . ' ' . $this->descNum . '/' . $this->orienNum;
  }

  function getFullCity()
  {
    return $this->zip . ', ' . $this->city;
  }

  function getAddress()
  {
    return $this->getFullStreet() . '\ln' . $this->getFullCity();
  }
}

?>