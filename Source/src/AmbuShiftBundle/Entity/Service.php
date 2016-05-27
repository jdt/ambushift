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

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function operatesDuring(TimeSlot $timeSlot)
    {
        $timeSlot->setService($this);
        $this->timeSlots->add($timeSlot);
    }

    public function runShift(Shift $shift)
    {
        $shift->setService($this);
        $this->shifts->add($shift);
    }

    public function operate(Vehicle $vehicle)
    {
        $vehicle->setService($this);
        $this->vehicles->add($vehicle);
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