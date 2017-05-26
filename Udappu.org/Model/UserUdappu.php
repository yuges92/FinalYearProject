<?php

class UserUdappu
{
    private $userID;
    private $username;
    private $password;
    private $role;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name=$value;
    }
}
