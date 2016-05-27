<?php
namespace Tests\AmbuShiftBundle\Resources\config\doctrine;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use AmbuShiftBundle\Entity\TimeSlot;
use AmbuShiftBundle\Entity\Time;
use AmbuShiftBundle\Entity\CrewPosition;
use AmbuShiftBundle\Entity\Vehicle;

class VehicleMappingTest extends KernelTestCase
{
    private $em;
    
    public function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()->get('doctrine')->getManager();
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
    }

    public function testMapping()
    {
        $this->em->getConnection()->beginTransaction();

        $position = new CrewPosition("Driver");
        $this->em->persist($position);

        $vehicle = new Vehicle("Ambulance 1");
        $vehicle->has($position);

        $this->em->persist($vehicle);
        $this->em->flush();
        $this->em->clear();

        $dbItem = $this->em->find('AmbuShiftBundle\Entity\Vehicle', $vehicle->getId());

        $this->assertEquals($vehicle->getDescription(), $dbItem->getDescription());
        $this->assertEquals(1, count($dbItem->getCrewPositions()));

        $this->em->getConnection()->rollback();
    }
}
