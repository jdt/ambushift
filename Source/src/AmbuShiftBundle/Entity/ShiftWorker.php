<?php
namespace AmbuShiftBundle\Entity;

class ShiftWorker
{
    private $id;

    private $user;
    private $crewPosition;
    private $vehicle;

    public function __construct(User $user, CrewPosition $position, Vehicle $vehicle)
    {
    }
}