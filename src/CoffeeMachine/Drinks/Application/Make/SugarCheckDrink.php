<?php

namespace Adsmurai\CoffeeMachine\Drinks\Application\Make;

use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkIncorrectSugar;

final class SugarCheckDrink
{
    public function check(int $sugars): bool
    {
        if ($sugars < 0 || $sugars > 2) {
            throw new DrinkIncorrectSugar();
        }

        return true;
    }
}