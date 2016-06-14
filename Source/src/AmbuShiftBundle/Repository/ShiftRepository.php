<?php
namespace AmbuShiftBundle\Repository;

use AmbuShiftBundle\Entity\Shift;
use AmbuShiftBundle\Entity\User;

use Doctrine\ORM\EntityManager;
use \DateTime;

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

    public function selectShiftsByUserAfter(User $user, DateTime $after)
    {
        $query = $this->em->createQueryBuilder();
        return $query->select('shift, shiftWorker, vehicle, user')
                     ->from('AmbuShiftBundle:Shift', 'shift')
                     ->leftJoin('shift.vehicle', 'vehicle')
                     ->leftJoin('shift.shiftWorkers', 'shiftWorker')
                     ->leftJoin('shiftWorker.user', 'user')
                     ->where($query->expr()->andX(
                                   $query->expr()->eq('user.id', ':id'),
                                   $query->expr()->gt('shift.to', ':date')
                               )
                     )
                     ->setParameter('id', $user->getId())
                     ->setParameter('date', $after)
                     ->getQuery()->getResult();
    }

    public function save(Shift $shift)
    {
        $this->em->persist($shift);
        $this->em->flush();   
    }
}
