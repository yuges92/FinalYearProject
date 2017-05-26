<?php
require_once('UserUdappu.php');
class Admin extends UserUdappu
{
    private $adminID;
    private $firstname;
    private $surname;
    private $dob;
    private $email;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name=$value;
    }
}
