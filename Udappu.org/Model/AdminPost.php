<?php
class AdminPost
{
    private $postID;
    private $title;
    private $description;
    private $adminID;
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
