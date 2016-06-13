<?php
namespace AmbuShiftBundle\ViewModel;

use AmbuShiftBundle\Entity\OperatingMonth;
use AmbuShiftBundle\Entity\Month;

class ShiftViewModel
{
    const DATETIMEFORMAT = "d-m-Y H:i:s";

    private $month;

    public function __construct(OperatingMonth $month)
    {
        $this->month = $month;
    }

    public function month()
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

        $month = new Month($this->month->getYear(), $this->month->getMonth());
        $earlier = $month->getEarlier();
        $later = $month->getLater();

        return 
        [
                "monthIndex"        => $this->month->getMonth(),
                "year"              => $this->month->getYear(),
                "earlier"           => 
                    [
                        "month" => $earlier->getMonth(),
                        "year"  => $earlier->getYear()
                    ],
                "later"             => 
                    [
                        "month" => $later->getMonth(),
                        "year"  => $later->getYear()
                    ],
                "shifts"            => $shifts
        ];
    }
}
