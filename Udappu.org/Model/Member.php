<?php
require_once('UserUdappu.php');
class Member extends UserUdappu
{
    private $memberID;
    private $firstname;
    private $surname;
    private $dob;
    private $email;
    private $gender;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name=$value;
    }
}
