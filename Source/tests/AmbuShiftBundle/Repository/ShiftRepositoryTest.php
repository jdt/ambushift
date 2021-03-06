<?php
namespace AmbuShiftBundle\Tests\Repository;

use AmbuShiftBundle\Entity\Shift;
use AmbuShiftBundle\Entity\Vehicle;
use AmbuShiftBundle\Repository\ShiftRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use \DateTime;

class ShiftRepositoryTest extends KernelTestCase
{
    private $em;
    private $repo;

    public function setUp()
    {
        self::bootKernel();
        $this->em = static::$kernel->getContainer()->get('doctrine')->getManager();
        $this->repo = new ShiftRepository($this->em);
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->em->close();
    }

    public function testGetShiftByIdShouldReturnShift()
    {
        $result = $this->repo->getShiftById(1);
        $this->assertNotNull($result);
    }

    public function testSelectShiftsByUserAfterShouldSelectShiftsStartedOnOrAfterDateTimeWhereUserEnrolled()
    {
        $query = $this->em->createQueryBuilder();
        $user = $query->select('user')
                      ->from('AmbuShiftBundle:User', 'user')
                      ->where($query->expr()->eq('user.id', ':id'))
                      ->setParameter('id', 2)
                      ->getQuery()->getOneOrNullResult();

        $shifts = $this->repo->selectShiftsByUserAfter($user, new DateTime("2016-05-06 5:00:00"));
        $this->assertEquals(2, count($shifts));

        $shifts = $this->repo->selectShiftsByUserAfter($user, new DateTime("2016-05-06 19:00:00"));
        $this->assertEquals(1, count($shifts));

        $query = $this->em->createQueryBuilder();
        $user2 = $query->select('user')
                      ->from('AmbuShiftBundle:User', 'user')
                      ->where($query->expr()->eq('user.id', ':id'))
                      ->setParameter('id', 1)
                      ->getQuery()->getOneOrNullResult();

        $shifts = $this->repo->selectShiftsByUserAfter($user2, new DateTime("2016-05-06 5:00:00"));
        $this->assertEquals(0, count($shifts));
    }

    public function testSave()
    {
        $this->em->getConnection()->beginTransaction();

        $res = $this->em->getRepository('AmbuShiftBundle\Entity\Shift')->findBy(array('from' => new DateTime("1986-11-16 12:13:00")));
        $this->assertEmpty($res);

        $vehicle = new Vehicle("test");
        $this->em->persist($vehicle);
        $this->repo->save(new Shift(new DateTime("1986-11-16 12:13:00"), new DateTime("1986-11-16 12:14:00"), $vehicle));

        $res = $this->em->getRepository('AmbuShiftBundle\Entity\Shift')->findBy(array('from' => new DateTime("1986-11-16 12:13:00")));
        $this->assertNotEmpty($res);

        $this->em->getConnection()->rollback();
    }
}
