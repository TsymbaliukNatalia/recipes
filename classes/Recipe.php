<?php 

class Recipe{
    private $id;
    private $title;
    private $description;
    private $time;
    private $image;
    private $user_id;
    private $date_add;
    
    private function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}