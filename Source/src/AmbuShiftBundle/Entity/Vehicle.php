<?php
namespace AmbuShiftBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Vehicle
{
    private $id;
    private $description;

    private $service;
    private $crewPositions;

    public function __construct($description)
    {
    	$this->description = $description;
        $this->crewPositions = new ArrayCollection();
    }
}