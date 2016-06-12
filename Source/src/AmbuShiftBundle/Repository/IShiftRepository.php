<?php
namespace AmbuShiftBundle\Repository;

use AmbuShiftBundle\Entity\Shift;
use Doctrine\ORM\EntityManager;

interface IShiftRepository
{
    function getShiftById($id);
    function save(Shift $shift);
}
