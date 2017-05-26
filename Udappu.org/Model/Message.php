<?php
class Message
{
    private $messageID;
    private $from_MemberID;
    private $to_MemberID;
    private $message;
    private $seen;
    private $message_Created_Date;


    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name=$value;
    }
}
