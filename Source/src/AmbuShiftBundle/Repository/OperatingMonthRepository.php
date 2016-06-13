<?php
namespace AmbuShiftBundle\Repository;

use AmbuShiftBundle\Repository\IOperatingMonthRepository;
use AmbuShiftBundle\Entity\Month;
use Doctrine\ORM\EntityManager;

class OperatingMonthRepository implements IOperatingMonthRepository
{
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getOperatingMonth(Month $month)
    {
        $query = $this->em->createQueryBuilder();
        return $query->select('operatingMonth, shift, vehicle, crewPosition, shiftWorker, user')
                     ->from('AmbuShiftBundle:OperatingMonth', 'operatingMonth')
                     ->leftJoin('operatingMonth.shifts', 'shift')
                     ->leftJoin('shift.vehicle', 'vehicle')
                     ->leftJoin('vehicle.crewPositions', 'crewPosition')
                     ->leftJoin('shift.shiftWorkers', 'shiftWorker')
                     ->leftJoin('shiftWorker.user', 'user')
                     ->where($query->expr()->andX(
                                   $query->expr()->eq('operatingMonth.year', ':year'),
                                   $query->expr()->eq('operatingMonth.month', ':month')
                               )
                     )
                     ->setParameter('year', $month->getYear())
                     ->setParameter('month', $month->getMonth())
                     ->getQuery()->getOneOrNullResult();
    }
}
