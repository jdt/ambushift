<?php
namespace AmbuShiftBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use AmbuShiftBundle\Entity\Vehicle;
use AmbuShiftBundle\Entity\ShiftWorker;
use \DateTime;

class Shift
{
    private $id;

    private $from;
    private $to;

    private $operatingMonth;
    private $shiftWorkers;

    private $vehicle;

    public function __construct(DateTime $from, DateTime $to, Vehicle $vehicle)
    {
    	$this->from = $from;
    	$this->to = $to;
        $this->vehicle = $vehicle;
        
        $this->shiftWorkers = new ArrayCollection();
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

    public function setOperatingMonth(OperatingMonth $operatingMonth)
    {
        $this->operatingMonth = $operatingMonth;
    }

    public function getShiftWorkers()
    {
        return $this->shiftWorkers->toArray();
    }

    public function assign(ShiftWorker $shiftWorker)
    {
        $this->shiftWorkers->add($shiftWorker);
    }
}