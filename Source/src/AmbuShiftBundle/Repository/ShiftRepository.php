<?php
namespace AmbuShiftBundle\Repository;

use AmbuShiftBundle\Entity\Shift;
use Doctrine\ORM\EntityManager;

class ShiftRepository implements IShiftRepository
{
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getShiftById($id)
    {
        $query = $this->em->createQueryBuilder();
        return $query->select('shift, vehicle, crewPosition')
                     ->from('AmbuShiftBundle:Shift', 'shift')
                     ->leftJoin('shift.vehicle', 'vehicle')
                     ->leftJoin('vehicle.crewPositions', 'crewPosition')
                     ->where($query->expr()->eq('shift.id', ':id'))
                     ->setParameter('id', $id)
                     ->getQuery()->getOneOrNullResult();
    }

    public function save(Shift $shift)
    {
        $this->em->persist($shift);
        $this->em->flush();   
    }
}
