<?php
namespace AmbuShiftBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Underscore\Types\Arrays;

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

    public function remove(CrewPosition $position)
    {
        $this->crewPositions->removeElement($position);
    }

    public function hasPosition(CrewPosition $position)
    {
        $position = Arrays::find($this->getCrewPositions(), function($p) use ($position) { return $p->getId() == $position->getId(); });
        if ($position == false)
            return false;
        return true;
    }

    public function setService($service)
    {
    	$this->service = $service;
    }
}