<?php
namespace AmbuShiftBundle\Entity;

class Time
{
    private $hours;
    private $minutes;
    private $seconds;

    public function __construct($hours, $minutes, $seconds = 0)
    {
    	$this->hours = $hours;
    	$this->minutes = $minutes;
    	$this->seconds = $seconds;
    }

    public function getHours()
    {
    	return $this->hours;
    }

    public function getMinutes()
    {
    	return $this->minutes;
    }

    public function getSeconds()
    {
    	return $this->seconds;
    }
}