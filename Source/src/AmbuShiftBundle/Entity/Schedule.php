<?php
namespace AmbuShiftBundle\Entity;

class Schedule
{
	private $timeSlots;

    public function __construct()
    {
    	$this->timeSlots = new ArrayCollection();
    }
}