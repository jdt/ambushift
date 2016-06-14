<?php
namespace AmbuShiftBundle\Repository;

use AmbuShiftBundle\Entity\Shift;
use AmbuShiftBundle\Entity\User;

use Doctrine\ORM\EntityManager;

use \DateTime;

interface IShiftRepository
{
    function getShiftById($id);
    function selectShiftsByUserAfter(User $user, DateTime $after);

    function save(Shift $shift);
}
