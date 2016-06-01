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
	private $worker1;
	private $worker2;

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
    	$this->worker1 = new ShiftWorker($user, $this->position1);
    	$this->worker2 = new ShiftWorker($user, $this->position2);

    	$vehicle = new Vehicle("Test 1");

    	$this->shift = new Shift(new DateTime("2016-06-01"), new DateTime("2016-06-02"), $vehicle);
    	$this->shift->assign($this->worker1);
    	$this->shift->assign($this->worker2);
    }

    public function testGetShiftWorkerForShouldReturnShiftWorkerForCrewPosition()
    {
    	$foundWorker = $this->shift->getShiftWorkerFor($this->position1);
    	$this->assertEquals($this->worker1, $foundWorker);

    	$foundWorker = $this->shift->getShiftWorkerFor($this->position2);
    	$this->assertEquals($this->worker2, $foundWorker);
    }

    public function testGetShiftWorkerForUnAssignedPositionShouldReturnNull()
    {
    	$foundWorker = $this->shift->getShiftWorkerFor(new CrewPosition("Test"));
    	$this->assertEquals(null, $foundWorker);
    }
}
