<?php
class UdappuEvent
{
    private $eventID;
    private $adminID;
    private $title;
    private $description;
    private $start_Date;
    private $end_Date;
    private $date_Posted;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name=$value;
    }
}
