<?php
class FriendList
{
    private $memberID;
    private $friend_MemberID;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name=$value;
    }
}
