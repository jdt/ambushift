<?php
namespace AmbuShiftBundle\Entity;

class Service
{
    private $id;
    private $description;

    public function __construct($description)
    {
    	$this->description = $description;
    }
}