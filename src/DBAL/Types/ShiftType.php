<?php
namespace App\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
class ShiftType extends Type
{
    const NAME = 'shift';
    const VALUES = ['morning', 'afternoon'];

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return "ENUM('morning', 'afternoon')";
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
