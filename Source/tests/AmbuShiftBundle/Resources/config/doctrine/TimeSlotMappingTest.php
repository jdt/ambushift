<?php
namespace Tests\AmbuShiftBundle\Resources\config\doctrine;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use AmbuShiftBundle\Entity\TimeSlot;
use AmbuShiftBundle\Entity\Time;

class TimeSlotMappingTest extends KernelTestCase
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

        $timeSlot = new TimeSlot(new Time(1, 0), new Time(2, 0));

        $this->em->persist($timeSlot);
        $this->em->flush();
        $this->em->clear();

        $dbItem = $this->em->find('AmbuShiftBundle\Entity\TimeSlot', $timeSlot->getId());

        $this->assertEquals($timeSlot->getFrom(), $dbItem->getFrom());
        $this->assertEquals($timeSlot->getTo(), $dbItem->getTo());

        $this->em->getConnection()->rollback();
    }
}
