<?php
namespace AmbuShiftBundle\ViewModel;

use AmbuShiftBundle\Entity\User;
use AmbuShiftBundle\Entity\Month;

class HomeViewModel
{
    const DATETIMEFORMAT = "d-m-Y H:i:s";

    private $shifts;
    private $user;

    public function __construct(array $shifts, User $user)
    {
        $this->shifts = $shifts;
        $this->user = $user;
    }

    public function shifts()
    {
        $shifts = [];

        foreach($this->shifts as $shift)
        {
            $shifts[] = 
            [
                "from"          => $shift->getFrom()->format(self::DATETIMEFORMAT),
                "to"            => $shift->getTo()->format("H:i:s"),
                "vehicle"       => $shift->getVehicle()->getDescription(),
                "crewPosition"  => $shift->getShiftWorkerForUser($this->user)->getCrewPosition()->getDescription()
            ];
        }

        return $shifts;
    }
}
