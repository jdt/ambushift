<?php
namespace AmbuShiftBundle\ViewModel;

use AmbuShiftBundle\Entity\OperatingMonth;

class ShiftViewModel
{
    const DATETIMEFORMAT = "d-m-Y H:i:s";

    private $month;

    public function __construct(OperatingMonth $month)
    {
        $this->month = $month;
    }

    public function shifts()
    {
        $shifts = [];

        foreach($this->month->getShifts() as $shift)
        {
            $shiftDate = "test";
            $crewPositions = [];

            foreach($shift->getVehicle()->getCrewPositions() as $position)
            {
                $shiftWorker = $shift->getShiftWorkerFor($position);
                if($shiftWorker != null)
                {
                    $crewPosition =
                    [
                        "hasShiftWorker" => true,
                        "description"    => $position->getDescription(),
                        "shiftWorkerName"    => $shiftWorker->getUser()->getName()
                    ];
                }
                else
                {
                    $crewPosition =
                    [
                        "hasShiftWorker" => false,
                        "description"    => $position->getDescription()
                    ];    
                }

                $crewPositions[] = $crewPosition;
            }

            foreach($shift->getShiftWorkers() as $shiftWorker)
            {
                if($shift->getVehicle()->hasPosition($shiftWorker->getCrewPosition()) === false)
                {
                    $crewPosition =
                    [
                        "hasShiftWorker" => true,
                        "description"    => $shiftWorker->getCrewPosition()->getDescription(),
                        "shiftWorkerName"    => $shiftWorker->getUser()->getName()
                    ];
                    $crewPositions[] = $crewPosition;
                }
            }

            $shifts[] = 
            [
                "dayIndex"          => $shift->getFrom()->format("N"),
                "from"              => $shift->getFrom()->format(self::DATETIMEFORMAT),
                "to"                => $shift->getTo()->format("H:i:s"),
                "vehicle"           => $shift->getVehicle()->getDescription(),
                "crewPositions"     => $crewPositions
            ];
        }

        return $shifts;
    }
}
