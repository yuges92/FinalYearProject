<?php
class FriendRequest
{
    private $from_MemberID;
    private $to_MemberID;
    private $decision;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name=$value;
    }
}
