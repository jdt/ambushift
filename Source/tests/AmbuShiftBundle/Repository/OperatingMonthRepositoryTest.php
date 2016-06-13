<?php
namespace AmbuShiftBundle\Tests\Repository;

use AmbuShiftBundle\Repository\OperatingMonthRepository;
use AmbuShiftBundle\Entity\Month;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OperatingMonthRepositoryTest extends KernelTestCase
{
    private $em;
    private $repo;

    public function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()->get('doctrine')->getManager();
        $this->repo = new OperatingMonthRepository($this->em);
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
    }

    public function testGetOperatingMonth()
    {
        $result = $this->repo->getOperatingMonth(new Month(2016, 5));
        $this->assertNotNull($result);
    }
}
