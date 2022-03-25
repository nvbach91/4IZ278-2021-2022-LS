<?php

class User
{
    public $name;
    public $email;
    public $phone;
    public $avatar;
    public $password;
    public $cpack;
    public $n_cards;

    /**
     * @param $name
     * @param $email
     * @param $phone
     * @param $avatar
     * @param $cpack
     * @param $n_cards
     */
    public function __construct($name, $email, $phone, $avatar, $password, $cpack = null, $n_cards = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->avatar = $avatar;
        $this->password = $password;
        $this->cpack = $cpack;
        $this->n_cards = $n_cards;
    }
}