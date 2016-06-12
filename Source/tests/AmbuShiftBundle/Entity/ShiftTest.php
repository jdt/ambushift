<?php
namespace Tests\AmbuShiftBundle\Entity;

use AmbuShiftBundle\Entity\Shift;
use AmbuShiftBundle\Entity\Vehicle;
use AmbuShiftBundle\Entity\ShiftWorker;
use AmbuShiftBundle\Entity\CrewPosition;
use AmbuShiftBundle\Entity\User;

use \DateTime;

use\PHPUnit_Framework_TestCase;

class ShiftTest extends PHPUnit_Framework_TestCase
{
	private $position1;
	private $position2;

    private $shift;
    
    public function setUp()
    {
    	$this->position1 = new CrewPosition("Position 1");
    	$this->position1->setId(1);

    	$this->position2 = new CrewPosition("Position 2");
    	$this->position2->setId(2);

    	$user = new User();

    	$vehicle = new Vehicle("Test 1");
        $vehicle->has($this->position1);
        $vehicle->has($this->position2);

    	$this->shift = new Shift(new DateTime("2016-06-01"), new DateTime("2016-06-02"), $vehicle);
    	$this->shift->enroll($user, $this->position1->getId());
    	$this->shift->enroll($user, $this->position2->getId());
    }

    public function testGetShiftWorkerForShouldReturnShiftWorkerForCrewPosition()
    {
    	$foundWorker = $this->shift->getShiftWorkerFor($this->position1);
    	$this->assertNotNull($foundWorker);
        $this->assertEquals($this->position1->getId(), $foundWorker->getCrewPosition()->getId());

    	$foundWorker = $this->shift->getShiftWorkerFor($this->position2);
    	$this->assertNotNull($foundWorker);
        $this->assertEquals($this->position2->getId(), $foundWorker->getCrewPosition()->getId());
    }

    public function testGetShiftWorkerForUnAssignedPositionShouldReturnNull()
    {
    	$foundWorker = $this->shift->getShiftWorkerFor(new CrewPosition("Test"));
    	$this->assertEquals(null, $foundWorker);
    }
}
