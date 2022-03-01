<?php

class Person
{
  private $firstName;
  private $surname;
  private $birthDate;
  private $job;
  private $jobAvail;
  private $contact;
  private $address;
  private $company;

  function __construct($firstName, $surname, $birthDate, $job, $jobAvail, $contact, $address, $company)
  {
    $this->firstName = $firstName;
    $this->surname = $surname;
    $this->birthDate = $birthDate;
    $this->job = $job;
    $this->jobAvail = $jobAvail;
    $this->contact = $contact;
    $this->address = $address;
    $this->company = $company;
  }

  function getJob()
  {
    return $this->job;
  }

  function getJobAvail()
  {
    return $this->jobAvail;
  }

  function getFullName()
  {
    return $this->firstName . ' ' . $this->surname;
  }

  function getAge()
  {
    return floor((time() - strtotime($this->birthDate)) / 31556926);
  }

  function getContact($type)
  {
    return $this->contact[$type];
  }

  function getAddress()
  {
    return $this->address;
  }

  function getCompany()
  {
    return $this->company;
  }
}

?>