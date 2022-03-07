<?php

class Person
{
    private $logo;
    private $companyName;
    private $firstName;
    private $lastName;
    private $birthdate;
    private $position;
    private $phone;
    private $email;
    private $website;
    private $street;
    private $streetNumber;
    private $city;
    private $available;

    public function __construct(
        $logo,
        $companyName,
        $firstName,
        $lastName,
        $birthdate,
        $position,
        $phone,
        $email,
        $website,
        $street,
        $streetNumber,
        $city,
        $psc
    )
    {
        $this->logo = $logo;
        $this->companyName = $companyName;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->birthdate = $birthdate;
        $this->position = $position;
        $this->phone = $phone;
        $this->email = $email;
        $this->website = $website;
        $this->street = $street;
        $this->streetNumber = $streetNumber;
        $this->city = $city;
        $this->psc = $psc;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @return mixed
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return mixed
     */
    public function getAvailable()
    {
        return $this->available;
    }

    public function getAddress()
    {
        return $this->city . ' ' . $this->street . ' ' . $this->streetNumber.', '. $this->psc;
    }

    public function getFullName()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getAge()
    {
        return date("Y") - $this->birthdate;
    }
}