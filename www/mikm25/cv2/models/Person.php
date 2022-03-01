<?php

require_once __DIR__ . '/../utils.php';

class Person
{
    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $street;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $position;

    /**
     * @var string
     */
    private $company;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $web;

    /**
     * @var bool
     */
    private $openedToOffer;

    /**
     * @var string
     */
    private $birthdayDate;

    public function __construct(
        string $firstname,
        string $lastname,
        string $street,
        string $zip,
        string $city,
        string $position,
        string $company,
        string $phone,
        string $email,
        string $web,
        bool $openedToOffer,
        string $birthdayDate
    )
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->street = $street;
        $this->zip = $zip;
        $this->city = $city;
        $this->position = $position;
        $this->company = $company;
        $this->phone = $phone;
        $this->email = $email;
        $this->web = $web;
        $this->openedToOffer = $openedToOffer;
        $this->birthdayDate = $birthdayDate;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }

    public function getFullName(): string
    {
        return "$this->firstname $this->lastname";
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getFullAddress(): string
    {
        return "$this->street, $this->city, $this->zip";
    }

    public function getPosition(): string
    {
        return $this->position;
    }

    public function getCompany(): string
    {
        return $this->company;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getWeb(): string
    {
        return $this->web;
    }

    public function isOpenedToOffer(): bool
    {
        return $this->openedToOffer;
    }

    public function getBirthdayDate(): string
    {
        return $this->birthdayDate;
    }

    public function getAge(): int
    {
        return getAgeByBirthdate($this->birthdayDate);
    }
}