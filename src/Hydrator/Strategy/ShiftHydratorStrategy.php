<?php

namespace App\Hydrator\Strategy;

use Laminas\Hydrator\Strategy\StrategyInterface;
use App\Enum\Shift;
class ShiftHydratorStrategy implements StrategyInterface
{
    public function extract($value, ?object $object = null): ?string
    {
        return null === $value ? null : Shift::tryFrom($value)->value;
    }

    public function hydrate($value, ?array $data): ?Shift
    {
        return null === $value ? null : Shift::tryFrom($value);
    }
}


