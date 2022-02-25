<?php
require('./utils.php');

class Person
{
    public function __construct($avatar, $firstname, $surname, $position, $birthday, $company, $street, $houseNumber, $orientationNumber, $city, $phone, $email, $companyEmail, $website, $applicable)
    {
        $this->avatar = $avatar;
        $this->firstname = $firstname;
        $this->surname = $surname;
        $this->position = $position;
        $this->birthday = $birthday;
        $this->company = $company;
        $this->street = $street;
        $this->houseNumber = $houseNumber;
        $this->orientationNumber = $orientationNumber;
        $this->city = $city;
        $this->phone = $phone;
        $this->email = $email;
        $this->companyEmail = $companyEmail;
        $this->website = $website;
        $this->applicable = $applicable;
    }

    function getName()
    {
        return "{$this->firstname} {$this->surname}";
    }

    function getAge()
    {
        return getAgeFromDate($this->birthday);
    }

    function getAddress()
    {
        return "{$this->street} {$this->orientationNumber}/{$this->houseNumber}, {$this->city}";
    }

    function isApplicable()
    {
        return $this->applicable ? "Hledám práci" : "Práci momentálně nehledám";
    }

}
