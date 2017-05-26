<?php
class MemberPost
{
    private $postID;
    private $title;
    private $description;
    private $memberID;
    private $privacy;
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
