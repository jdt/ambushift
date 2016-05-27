<?php
namespace AmbuShiftBundle\Repository\Doctrine;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

use AmbuShiftBundle\Entity\Time;

class AmbuShiftTimeType extends Type
{
    const TYPENAME = 'AmbuShiftTimeType';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "VARCHAR(8)";
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $parts = explode(":", $value);
        return new Time($parts[0], $parts[1], $parts[2]);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->getHours().":".$value->getMinutes().":".$value->getSeconds();
    }

    public function getName()
    {
        return self::TYPENAME;
    }
}