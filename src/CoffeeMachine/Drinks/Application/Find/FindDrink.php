<?php

namespace Adsmurai\CoffeeMachine\Drinks\Application\Find;

use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkNotFound;

final class FindDrink
{
    /**
     * Check allowed drink type
     * @param string $drinkType
     * @return bool
     */
    public function find(string $drinkType): bool
    {
        if (!in_array($drinkType, ['tea', 'coffee', 'chocolate'])) {
            throw new DrinkNotFound();
        }

        return true;
    }
}