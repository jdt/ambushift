<?php
namespace AmbuShiftBundle\Entity;

use AmbuShiftBundle\Entity\Vehicle;
use Doctrine\Common\Collections\ArrayCollection;

class CrewPosition
{
	private $id;
	private $description;

    private $shiftWorkers;
	private $vehicle;

    public function __construct($description)
    {
    	$this->description = $description;

        $this->shiftWorkers = new ArrayCollection();
    }

    public function getId()
    {
    	return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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