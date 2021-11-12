<?php

namespace Adsmurai\CoffeeMachine\Drinks\Domain;

use Adsmurai\Shared\Domain\ValueObject\FloatValueObject;

final class DrinkPrice extends FloatValueObject
{
    private array $drinkPrices = [
        'tea' => 0.4,
        'coffee' => 0.5,
        'chocolate' => 0.6
    ];

    public function __construct(string $value)
    {
        if (!array_key_exists($value, $this->drinkPrices)) {
            throw new DrinkNotFound();
        }

        parent::__construct($this->drinkPrices[$value]);
    }
}