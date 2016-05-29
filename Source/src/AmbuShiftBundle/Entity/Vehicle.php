<?php
namespace AmbuShiftBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Vehicle
{
    private $id;
    private $description;

    private $crewPositions;

    private $shifts;
    private $service;

    public function __construct($description)
    {
    	$this->description = $description;
        $this->crewPositions = new ArrayCollection();
        $this->shifts = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getCrewPositions()
    {
        return $this->crewPositions->toArray();
    }

    public function has(CrewPosition $position)
    {
        $position->setVehicle($this);
        $this->crewPositions->add($position);
    }

    public function setService($service)
    {
    	$this->service = $service;
    }
}