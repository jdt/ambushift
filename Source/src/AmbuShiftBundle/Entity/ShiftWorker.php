<?php
namespace AmbuShiftBundle\Entity;

class ShiftWorker
{
    private $id;

    private $user;
    private $crewPosition;

    public function __construct(User $user, CrewPosition $crewPosition)
    {
    	$this->user = $user;
    	$this->crewPosition = $crewPosition;
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
}