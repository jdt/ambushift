<?php
namespace AmbuShiftBundle\Entity;

class Service
{
    private $id;
    private $description;
    private $shifts;

    public function __construct($description)
    {
    	$this->description = $description;
        $this->shifts = new ArrayCollection();
    }

    public function getShifts()
    {
        return $this->shifts->toArray();
    }
}