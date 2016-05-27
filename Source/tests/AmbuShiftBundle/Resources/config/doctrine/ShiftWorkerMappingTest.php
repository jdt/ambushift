<?php
namespace Tests\AmbuShiftBundle\Resources\config\doctrine;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use AmbuShiftBundle\Entity\Shift;
use AmbuShiftBundle\Entity\Vehicle;
use AmbuShiftBundle\Entity\User;
use AmbuShiftBundle\Entity\ShiftWorker;
use AmbuShiftBundle\Entity\CrewPosition;

use \DateTime;

class ShiftWorkerMappingTest extends KernelTestCase
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
        $user = $this->em->find("AmbuShiftBundle\Entity\User", 1);

        $this->em->persist($position);

        $worker = new ShiftWorker($user, $position);

        $this->em->persist($worker);
        $this->em->flush();
        $this->em->clear();

        $dbItem = $this->em->find('AmbuShiftBundle\Entity\ShiftWorker', $worker->getId());

        $this->assertEquals($worker->getUser()->getId(), $dbItem->getUser()->getId());
        $this->assertEquals($worker->getCrewPosition()->getId(), $dbItem->getCrewPosition()->getId());

        $this->em->getConnection()->rollback();
    }
}
