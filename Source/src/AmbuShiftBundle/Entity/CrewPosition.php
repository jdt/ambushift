<?php
namespace AmbuShiftBundle\Entity;

use AmbuShiftBundle\Entity\Vehicle;

class CrewPosition
{
	private $id;
	private $description;

	private $vehicle;

    public function __construct($description)
    {
    	$this->description = $description;
    }

    public function getId()
    {
    	return $this->id;
    }

    public function getDescription()
    {
    	return $this->description;
    }

    public function setVehicle(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }
}