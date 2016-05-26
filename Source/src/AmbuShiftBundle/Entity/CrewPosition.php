<?php
namespace AmbuShiftBundle\Entity;

class CrewPosition
{
	private $id;
	private $description;

	private $vehicle;

    public function __construct($description)
    {
    	$this->description = $description;
    }
}