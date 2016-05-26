<?php
namespace AmbuShiftBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Service
{
    private $id;
    private $description;

    private $timeSlots;
    private $shifts;
    private $vehicles;

    public function __construct($description)
    {
    	$this->description = $description;

        $this->timeSlots = new ArrayCollection();
        $this->shifts = new ArrayCollection();
        $this->vehicles = new ArrayCollection();
    }

    public function getShifts()
    {
        return $this->shifts->toArray();
    }

    public function getTimeSlots()
    {
    	return $this->timeSlots->toArray();
    }

    public function getVehicles()
    {
    	return $this->vehicles->toArray();
    }
}