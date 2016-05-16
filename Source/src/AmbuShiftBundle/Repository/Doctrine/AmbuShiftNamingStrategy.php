<?php
namespace AmbuShiftBundle\Repository\Doctrine;

use Doctrine\ORM\Mapping\UnderscoreNamingStrategy;

class AmbuShiftNamingStrategy extends UnderscoreNamingStrategy
{
    private $prefix;

    public function __construct($prefix)
    {
        $this->prefix = $prefix;
    }

    public function classToTableName($className)
    {
        return $this->prefix . parent::classToTableName($className);
    }
}