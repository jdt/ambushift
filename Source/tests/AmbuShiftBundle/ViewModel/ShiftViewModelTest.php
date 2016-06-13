<?php
namespace Tests\AmbuShiftBundle\Entity;

use AmbuShiftBundle\Entity\Shift;
use AmbuShiftBundle\Entity\Vehicle;
use AmbuShiftBundle\Entity\CrewPosition;
use AmbuShiftBundle\Entity\User;
use AmbuShiftBundle\Entity\OperatingMonth;
use AmbuShiftBundle\ViewModel\ShiftViewModel;

use \DateTime;

use\PHPUnit_Framework_TestCase;

class ShiftViewModelTest extends PHPUnit_Framework_TestCase
{
    private $month;
    
    public function setUp()
    {
    	$position1 = new CrewPosition("Position 1");
    	$position1->setId(1);

    	$position2 = new CrewPosition("Position 2");
    	$position2->setId(2);

        $position3 = new CrewPosition("Old Position");
        $position3->setId(3);

    	$user1 = new User();
        $user1->setName("User 1");
        $user2 = new User();
        $user2->setName("User 2");
    	
    	$vehicle = new Vehicle("Test 1");
        $vehicle->has($position1);
        $vehicle->has($position2);
        $vehicle->has($position3);

    	$shift = new Shift(new DateTime("2016-06-01 12:00:00"), new DateTime("2016-06-01 18:00:00"), $vehicle);
        $shift->setId(42);
        $shift->enroll($user1, $position1->getId());
        $shift->enroll($user2, $position3->getId());

        $vehicle->remove($position3);

        $this->month = new OperatingMonth(2016, 6);
        $this->month->addShift($shift);
    }

    public function testMonthsShouldSerializeMonth()
    {
        $viewModel = new ShiftViewModel($this->month);
        $actual = $viewModel->month();
        
        $expected =
        [
            "monthIndex"    => 6,
            "year"          => 2016,
            "earlier"       => 
            [
                "year"  => 2016,
                "month" => 5
            ],
            "later"       => 
            [
                "year"  => 2016,
                "month" => 7
            ],
            "shifts"        =>
            [
                [
                    "shiftId"       => 42,
                    "dayIndex"      => "3",
                    "from"          => "01-06-2016 12:00:00",
                    "to"            => "18:00:00",
                    "vehicle"       => "Test 1",
                    "crewPositions" =>
                    [
                        [
                            "crewPositionId"    => 1,
                            "description"       => "Position 1",
                            "hasShiftWorker"    => true,
                            "shiftWorkerName"   => "User 1"
                        ],
                        [
                            "crewPositionId"    => 2,
                            "description"       => "Position 2",
                            "hasShiftWorker"    => false
                        ],
                        [
                            "crewPositionId"    => 3,
                            "description"       => "Old Position",
                            "hasShiftWorker"    => true,
                            "shiftWorkerName"   => "User 2"
                        ]
                    ]
                ]
            ]
        ];

        $this->assertEquals($expected, $actual);
    }
}
