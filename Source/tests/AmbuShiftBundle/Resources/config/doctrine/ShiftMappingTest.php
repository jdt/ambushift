<?php
namespace Tests\AmbuShiftBundle\Resources\config\doctrine;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use AmbuShiftBundle\Entity\Shift;
use AmbuShiftBundle\Entity\Vehicle;
use AmbuShiftBundle\Entity\User;
use AmbuShiftBundle\Entity\ShiftWorker;
use AmbuShiftBundle\Entity\CrewPosition;

use \DateTime;

class ShiftMappingTest extends KernelTestCase
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
        $position = new CrewPosition("Driver");
        
        $user = $this->em->find("AmbuShiftBundle\Entity\User", 1);

        $this->em->persist($vehicle);
        $this->em->persist($position);

        $shift = new Shift(new DateTime("2016-05-27 12:00:00"), new DateTime("2016-05-27 18:00:00"), $vehicle);

        $worker = new ShiftWorker($user, $position);
        $shift->assign($worker);

        $this->em->persist($shift);
        $this->em->flush();
        $this->em->clear();

        $dbItem = $this->em->find('AmbuShiftBundle\Entity\Shift', $shift->getId());

        $this->assertEquals($shift->getFrom(), $dbItem->getFrom());
        $this->assertEquals($shift->getTo(), $dbItem->getTo());
        $this->assertEquals(1, count($shift->getShiftWorkers()));

        $this->em->getConnection()->rollback();
    }
}
