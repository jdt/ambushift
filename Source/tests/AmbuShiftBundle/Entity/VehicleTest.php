<?php
namespace Tests\AmbuShiftBundle\Entity;

use AmbuShiftBundle\Entity\Shift;
use AmbuShiftBundle\Entity\Vehicle;
use AmbuShiftBundle\Entity\ShiftWorker;
use AmbuShiftBundle\Entity\CrewPosition;
use AmbuShiftBundle\Entity\User;

use \DateTime;

use\PHPUnit_Framework_TestCase;

class VehicleTest extends PHPUnit_Framework_TestCase
{
    private $position;
    private $vehicle;
    
    public function setUp()
    {
    	$this->position = new CrewPosition("Position 1");
    	$this->position->setId(1);

        $this->vehicle = new Vehicle("Vehicle");
        $this->vehicle->has($this->position);
    }

    public function testHasPositionReturnsTrueIfVehicleHasCrewPosition()
    {
    	$this->assertTrue($this->vehicle->hasPosition($this->position));
        $this->assertFalse($this->vehicle->hasPosition(new CrewPosition("test")));
    }
}
