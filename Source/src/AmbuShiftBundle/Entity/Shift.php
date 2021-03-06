<?php
namespace AmbuShiftBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use AmbuShiftBundle\Entity\Vehicle;
use AmbuShiftBundle\Entity\ShiftWorker;
use Underscore\Types\Arrays;

use \DateTime;

class Shift
{
    private $id;

    private $from;
    private $to;

    private $shiftWorkers;

    private $operatingMonth;
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

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function getVehicle()
    {
        return $this->vehicle;
    }

    public function setOperatingMonth(OperatingMonth $operatingMonth)
    {
        $this->operatingMonth = $operatingMonth;
    }

    public function getShiftWorkers()
    {
        return $this->shiftWorkers->toArray();
    }
    
    public function getShiftWorkerFor(CrewPosition $position)
    {
        $worker = Arrays::find($this->getShiftWorkers(), function($w) use ($position) { return $w->getCrewPosition()->getId() == $position->getId(); });
        if ($worker == false)
            return null;
        return $worker;
    }

    public function getShiftWorkerForUser(User $user)
    {
        $worker = Arrays::find($this->getShiftWorkers(), function($w) use ($user) { return $w->getUser()->getId() == $user->getId(); });
        if ($worker == false)
            return null;
        return $worker;
    }

    public function enroll(User $user, $crewPositionId)
    {
        $crewPosition = Arrays::find($this->getVehicle()->getCrewPositions(), function($cp) use ($crewPositionId) { return $cp->getId() == $crewPositionId; });
        $shiftWorker = new ShiftWorker($user, $crewPosition);
        
        $shiftWorker->setShift($this);
        $this->shiftWorkers->add($shiftWorker);
    }
}