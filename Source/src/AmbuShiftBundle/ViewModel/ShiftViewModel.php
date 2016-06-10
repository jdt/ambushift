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
                $crewPosition =
                [
                    "crewPositionId"    => $position->getId(),
                    "description"       => $position->getDescription()
                ];

                if($shiftWorker != null)
                {
                    $crewPosition["hasShiftWorker"] = true;
                    $crewPosition["shiftWorkerName"] = $shiftWorker->getUser()->getName();
                }
                else
                {
                    $crewPosition["hasShiftWorker"] = false;
                }

                $crewPositions[] = $crewPosition;
            }

            foreach($shift->getShiftWorkers() as $shiftWorker)
            {
                if($shift->getVehicle()->hasPosition($shiftWorker->getCrewPosition()) === false)
                {
                    $crewPosition =
                    [
                        "crewPositionId"    => $shiftWorker->getCrewPosition()->getId(),
                        "hasShiftWorker"    => true,
                        "description"       => $shiftWorker->getCrewPosition()->getDescription(),
                        "shiftWorkerName"   => $shiftWorker->getUser()->getName()
                    ];
                    $crewPositions[] = $crewPosition;
                }
            }

            $shifts[] = 
            [
                "shiftId"           => $shift->getId(),
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
