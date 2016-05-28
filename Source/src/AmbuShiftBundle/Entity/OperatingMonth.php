<?php
namespace AmbuShiftBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class OperatingMonth
{
    private $id;
    
    private $year;
    private $month;

    private $service;
    private $shifts;

    public function __construct($year, $month)
    {
        $this->year = $year;
        $this->month = $month;

        $this->shifts = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getMonth()
    {
        return $this->month;
    }

    public function getShifts()
    {
        return $this->shifts->toArray();
    }

    public function addShift(Shift $shift)
    {
        $shift->setOperatingMonth($this);
        $this->shifts->add($shift);
    }

    public function setService(Service $service)
    {
        $this->service = $service;
    }
}