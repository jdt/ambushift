<?php
namespace AmbuShiftBundle\Repository;

use AmbuShiftBundle\Entity\Month;
use Doctrine\ORM\EntityManager;

interface IOperatingMonthRepository
{
    function getOperatingMonth(Month $month);
}
