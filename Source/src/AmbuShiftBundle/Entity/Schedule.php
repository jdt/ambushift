<?php
namespace AmbuShiftBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Schedule
{
	private $timeSlots;

    public function __construct()
    {
    	$this->timeSlots = new ArrayCollection();
    }
}