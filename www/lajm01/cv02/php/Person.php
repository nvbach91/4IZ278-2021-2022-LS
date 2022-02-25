<?php

class Person{

    public $avatar_url;
    public $last_name;
    public $first_name;
    public $birth_date;
    public $job;
    public $company_name;
    public $street;
    public $post;
    public $house_number;
    public $city;
    public $phone;
    public $email;
    public $web;
    public $job_ready;
 
    function __construct($avatar_url, $last_name, $first_name, $birth_date, $job, $company_name, $street, $post, $house_number, $city, $phone, $email, $web, $job_ready) {
        $this->avatar_url = $avatar_url;
        $this->last_name = $last_name;
        $this->first_name = $first_name;
        $this->birth_date = $birth_date;
        $this->job = $job;
        $this->company_name = $company_name;
        $this->house_number = $house_number;
        $this->street = $street;
        $this->city = $city;
        $this->post = $post;
        $this->phone = $phone;
        $this->email = $email;
        $this->web = $web;
        $this->job_ready = $job_ready;
    }

    public function getFullName(){
        return $this->first_name." ".$this->last_name;
    }

    public function getAddress(){
        return $this->street." ".$this->house_number.", ".$this->city.", ".$this->post;
    }

    public function getAge(){
        $time_zone  = new DateTimeZone('Europe/Brussels');
        return DateTime::createFromFormat('j-M-Y', $this->birth_date)->diff(new DateTime('now', $time_zone))->y;
    }
}
?>