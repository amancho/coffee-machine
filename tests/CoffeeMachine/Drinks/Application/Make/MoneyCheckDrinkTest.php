<?php

namespace Adsmurai\Tests\CoffeeMachine\Drinks\Application\Make;

use Adsmurai\CoffeeMachine\Drinks\Application\Make\MoneyCheckDrink;
use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkLackOfMoney;

use PHPUnit\Framework\TestCase;

class MoneyCheckDrinkTest extends TestCase
{
    private array $allowedDrintkTypes = [
        'tea' => 0.4,
        'coffee' => 0.5,
        'chocolate' => 0.6
    ];

    public function test_money_check_drink_tea_fails()
    {
        $this->expectException(DrinkLackOfMoney::class);
        (new MoneyCheckDrink())->check('tea', 0.1);
    }

    public function test_money_check_drink_coffee_fails()
    {
        $this->expectException(DrinkLackOfMoney::class);
        (new MoneyCheckDrink())->check('coffee', 0.1);
    }

    public function test_money_check_drink_chocolate_fails()
    {
        $this->expectException(DrinkLackOfMoney::class);
        (new MoneyCheckDrink())->check('chocolate', 0.1);
    }

    public function test_money_check_drink_works()
    {
        foreach($this->allowedDrintkTypes as $type => $money){
            $result = (new MoneyCheckDrink())->check($type, $money);
            $this->assertTrue($result);
        }
    }
}