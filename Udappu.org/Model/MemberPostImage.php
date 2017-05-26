<?php
class MemberPostImage
{
    private $postID;
    private $memberID;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name=$value;
    }
}
