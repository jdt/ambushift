<?php
namespace Tests\AmbuShiftBundle\Resources\config\doctrine;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use AmbuShiftBundle\Entity\Service;
use AmbuShiftBundle\Entity\Time;
use AmbuShiftBundle\Entity\TimeSlot;
use AmbuShiftBundle\Entity\OperatingMonth;
use AmbuShiftBundle\Entity\Vehicle;

use \DateTime;

class ServiceMappingTest extends KernelTestCase
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

        $service = new Service("Service 1");

        $timeSlot = new TimeSlot(new Time(12, 0), new Time(18, 0));
        $vehicle = new Vehicle("Ambulance 1");
        $month = new OperatingMonth(2016, 1);

        $service->operatesDuring($timeSlot);
        $service->operates($month);
        $service->operate($vehicle);

        $this->em->persist($service);
        $this->em->flush();
        $this->em->clear();

        $dbItem = $this->em->find('AmbuShiftBundle\Entity\Service', $service->getId());

        $this->assertEquals($service->getDescription(), $dbItem->getDescription());

        $this->assertEquals(1, count($dbItem->getTimeSlots()));
        $this->assertEquals(1, count($dbItem->getOperatingMonths()));
        $this->assertEquals(1, count($dbItem->getVehicles()));
    
        $this->em->getConnection()->rollback();
    }
}
