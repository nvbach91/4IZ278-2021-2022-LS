<?php
class Person
{
    public $logo;
    public $companyName;
    public $firstName;
    public $lastName;
    public $age;
    public $position;
    public $phone;
    public $email;
    public $website;
    public $street;
    public $streetNumber;
    public $city;
    public $available;

    public function __construct(
        $logo,
        $companyName,
        $firstName,
        $lastName,
        $age,
        $position,
        $phone,
        $email,
        $website,
        $street,
        $streetNumber,
        $city,
        $available
    ) {
        $this->logo = $logo;
        $this->companyName = $companyName;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
        $this->position = $position;
        $this->phone = $phone;
        $this->email = $email;
        $this->website = $website;
        $this->street = $street;
        $this->streetNumber = $streetNumber;
        $this->city = $city;
        $this->available = $available;
    }
    /**
     * 
     */
    public function getAddress()
    {
        return $this->city . ' ' . $this->street . ' ' . $this->streetNumber;
    }
    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }
    public function getAge($year)
    {
        return date("Y") - $year;
    }
}

?>