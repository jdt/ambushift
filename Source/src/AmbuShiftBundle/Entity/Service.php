<?php
namespace AmbuShiftBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Service
{
    private $id;
    private $description;

    private $shifts;
    private $schedule;
    private $vehicles;

    public function __construct($description)
    {
    	$this->description = $description;

        $this->shifts = new ArrayCollection();
        $this->vehicles = new ArrayCollection();
    }

    public function getShifts()
    {
        return $this->shifts->toArray();
    }

    public function getSchedule()
    {
    	return $this->schedule;
    }

    public function getVehicles()
    {
    	return $this->vehicles;
    }
}