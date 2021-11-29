<?php

namespace Adsmurai\CoffeeMachine\Orders\Domain;

use Adsmurai\Shared\Domain\ValueObject\FloatValueObject;

final class OrderPrice extends FloatValueObject
{
    public function __construct(float $value)
    {
        parent::__construct($value);
    }
}