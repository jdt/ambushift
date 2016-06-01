<?php
namespace AmbuShiftBundle\Tests\Repository;

use AmbuShiftBundle\Repository\OperatingMonthRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use \Doctrine\DBAL\Logging\DebugStack;

class OperatingMonthRepositoryTest extends KernelTestCase
{
    private $em;
    private $repo;

    public function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()->get('doctrine')->getManager();
        $this->repo = new OperatingMonthRepository($this->em);

        $this->stack = new DebugStack();
        $this->em->getConnection()->getConfiguration()->setSQLLogger($this->stack);
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
    }

    public function testGetOperatingMonth()
    {
        $result = $this->repo->getOperatingMonth("2016", "5");
        $this->assertNotNull($result);
    }
}
