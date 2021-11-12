<?php

namespace Adsmurai\CoffeeMachine\Drinks\Application\Make;

use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkLackOfMoney;

final class MoneyCheckDrink
{
    public function check(string $type, float $money): bool
    {
        /**
         * Tea       --> 0.4
         * Coffee    --> 0.5
         * Chocolate --> 0.6
         */

        if ($type == 'tea' && $money < 0.4) {
            throw new DrinkLackOfMoney($type, 0.4);
        }

        if ($type == 'coffee' && $money < 0.5) {
            throw new DrinkLackOfMoney($type, 0.5);
        }

        if ($type == 'chocolate' && $money < 0.4) {
            throw new DrinkLackOfMoney($type, 0.6);
        }

        return true;
    }
}