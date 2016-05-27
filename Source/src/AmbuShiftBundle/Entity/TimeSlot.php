<?php
namespace AmbuShiftBundle\Entity;

use AmbuShiftBundle\Entity\Time;
use AmbuShiftBundle\Entity\Service;


class TimeSlot
{
    private $id;

    private $from;
    private $to;

    private $service;

    public function __construct(Time $from, Time $to)
    {
    	$this->from = $from;
    	$this->to = $to;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function setService($service)
    {
    	$this->service = $service;
    }
}