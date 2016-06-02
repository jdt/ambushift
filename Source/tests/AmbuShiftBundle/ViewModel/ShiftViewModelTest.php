<?php
namespace Tests\AmbuShiftBundle\Entity;

use AmbuShiftBundle\Entity\Shift;
use AmbuShiftBundle\Entity\Vehicle;
use AmbuShiftBundle\Entity\ShiftWorker;
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
    	
        $worker1 = new ShiftWorker($user1, $position1);
    	$worker2 = new ShiftWorker($user2, $position3);

    	$vehicle = new Vehicle("Test 1");
        $vehicle->has($position1);
        $vehicle->has($position2);

    	$shift = new Shift(new DateTime("2016-06-01 12:00:00"), new DateTime("2016-06-01 18:00:00"), $vehicle);
        $shift->assign($worker1);
        $shift->assign($worker2);

        $this->month = new OperatingMonth(2016, 6);
        $this->month->addShift($shift);
    }

    public function testShiftsShouldSerializeMonth()
    {
        $viewModel = new ShiftViewModel($this->month);
        $actual = $viewModel->shifts();
        
        $expected =
        [
            [
                "dayIndex"      => "3",
                "from"          => "01-06-2016 12:00:00",
                "to"            => "01-06-2016 18:00:00",
                "vehicle"       => "Test 1",
                "crewPositions" =>
                [
                    [
                        "hasShiftWorker"    => true,
                        "description"       => "Position 1",
                        "shiftWorkerName"   => "User 1"
                    ],
                    [
                        "hasShiftWorker"    => false,
                        "description"       => "Position 2"
                    ],
                    [
                        "hasShiftWorker"    => true,
                        "description"       => "Old Position",
                        "shiftWorkerName"   => "User 2"
                    ]
                ]
            ]
        ];

        $this->assertEquals($expected, $actual);
    }
}
