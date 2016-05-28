<?php
namespace Tests\AmbuShiftBundle\Resources\config\doctrine;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use AmbuShiftBundle\Entity\Shift;
use AmbuShiftBundle\Entity\OperatingMonth;
use AmbuShiftBundle\Entity\CrewPosition;
use AmbuShiftBundle\Entity\Vehicle;

use \DateTime;

class OperatingMonthMappingTest extends KernelTestCase
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
        
        $vehicle = new Vehicle("Ambulance 1");
        $this->em->persist($vehicle);

        $month = new OperatingMonth(2016, 5);

        $shift = new Shift(new DateTime("2014-01-01 12:00:00"), new DateTime("2014-01-01 18:00:00"), $vehicle);
        $month->addShift($shift);

        $this->em->persist($month);
        $this->em->flush();
        $this->em->clear();

        $dbItem = $this->em->find('AmbuShiftBundle\Entity\OperatingMonth', $month->getId());

        $this->assertEquals($month->getYear(), $dbItem->getYear());
        $this->assertEquals($month->getMonth(), $dbItem->getMonth());
        $this->assertEquals(1, count($dbItem->getShifts()));

        $this->em->getConnection()->rollback();
    }
}
