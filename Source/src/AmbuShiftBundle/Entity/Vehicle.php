<?php
namespace AmbuShiftBundle\Entity;

class Vehicle
{
    private $id;
    private $description;

    public function __construct($description)
    {
    	$this->description = $description;
    }
}