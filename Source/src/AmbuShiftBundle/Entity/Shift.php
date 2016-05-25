<?php
namespace AmbuShiftBundle\Entity;

use \DateTime;

class Shift
{
    private $id;

    private $from;
    private $to;

    private $vehicle;
    private $shiftWorkers;

    public function __construct(DateTime $from, DateTime $to)
    {
    	$this->from = $from;
    	$this->to = $to;
    }
}