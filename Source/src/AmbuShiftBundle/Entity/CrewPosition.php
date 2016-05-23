<?php
namespace AmbuShiftBundle\Entity;

class CrewPosition
{
	private $id;
	private $description;

    public function __construct($description)
    {
    	$this->description = $description;
    }
}