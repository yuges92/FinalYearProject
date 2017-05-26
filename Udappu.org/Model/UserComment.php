<?php
class UserComment
{
    private $commentID;
    private $postID;
    private $memberID;
    private $comment;
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
