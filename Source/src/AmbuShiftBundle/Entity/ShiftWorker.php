<?php
namespace AmbuShiftBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class ShiftWorker
{
    private $id;

    private $user;
    private $crewPosition;

    private $shift;

    public function __construct(User $user, CrewPosition $crewPosition)
    {
    	$this->user = $user;
    	$this->crewPosition = $crewPosition;

        $this->shifts = new ArrayCollection();
    }

    public function getId()
    {
    	return $this->id;
    }

    public function getUser()
    {
    	return $this->user;
    }

    public function getCrewPosition()
    {
    	return $this->crewPosition;
    }

    public function setShift(Shift $shift)
    {
        $this->shift = $shift;
    }
}