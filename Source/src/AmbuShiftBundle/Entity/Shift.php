<?php
namespace AmbuShiftBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
        
        $this->shiftWorkers = new ArrayCollection();
    }
}