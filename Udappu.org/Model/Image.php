<?php
class Image
{
    private $imageID;
    private $file_Name;
    private $folder_Name;

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name=$value;
    }
}
