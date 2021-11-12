<?php

namespace Adsmurai\Tests\CoffeeMachine\Drinks\Application\Make;

use Adsmurai\CoffeeMachine\Drinks\Application\Make\SugarCheckDrink;
use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkIncorrectSugar;

use PHPUnit\Framework\TestCase;

class SugarCheckDrinkTest extends TestCase
{

    public function test_less_sugar_check_drink_fails()
    {
        $this->expectException(DrinkIncorrectSugar::class);
        (new SugarCheckDrink())->check(-1);
    }

    public function test_sugar_check_drink_fails()
    {
        $this->expectException(DrinkIncorrectSugar::class);
        (new SugarCheckDrink())->check(3);
    }

    public function test_sugar_check_drink_works()
    {
        $result = (new SugarCheckDrink())->check(rand(0,2));
        $this->assertTrue($result);
    }
}