<?php
namespace AmbuShiftBundle\Repository;

use Doctrine\ORM\EntityManager;

interface IOperatingMonthRepository
{
    function getOperatingMonth($year, $month);
}
