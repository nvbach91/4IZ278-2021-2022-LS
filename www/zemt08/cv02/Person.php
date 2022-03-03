<?php
class Person
{
    private $fname;
    private $lname;
    private $tel;
    private $email;
    private $job;
    private $company;
    private $street;
    private $street_num;
    private $street_num2;
    private $city;
    private $web;
    private $contracts;
    private $birthDate;

    public function __construct(
        $fname,
        $lname,
        $tel,
        $email,
        $job,
        $company,
        $street,
        $street_num,
        $street_num2,
        $city,
        $web,
        $contracts,
        $birthDate
    ) {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->tel = $tel;
        $this->email = $email;
        $this->job = $job;
        $this->company = $company;
        $this->street = $street;
        $this->street_num = $street_num;
        $this->street_num2 = $street_num2;
        $this->city = $city;
        $this->web = $web;
        $this->contracts = $contracts;
        $this->birthDate = $birthDate;
    }

    public function getFirstName()
    {
        return $this->fname;
    }
    public function getLastName()
    {
        return $this->lname;
    }
    public function getTel()
    {
        return $this->tel;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getJob()
    {
        return $this->job;
    }
    public function getCompany()
    {
        return $this->company;
    }
    public function getAddress()
    {
        return $this->street . ' ' . $this->street_num . '/' . $this->street_num2 . ', ' . $this->city;
    }
    public function getWeb()
    {
        return $this->web;
    }
    public function getAvailable()
    {
        return $this->contracts;
    }
    public function getAge()
    {
        return date("Y") - $this->birthDate;
    }
}
