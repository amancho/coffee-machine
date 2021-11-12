<?php

namespace Adsmurai\Tests\CoffeeMachine\Drinks\Application\Find;

use Adsmurai\CoffeeMachine\Drinks\Application\Find\FindDrink;
use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkNotFound;
use PHPUnit\Framework\TestCase;

class FindDrinkTest extends TestCase
{
    private array $allowedDrintkTypes = ['coffee', 'tea', 'chocolate'];

    public function test_find_fails()
    {
        $this->expectException(DrinkNotFound::class);

        $type = substr(str_shuffle('abcdefgh'), 0,5);
        (new FindDrink())->find($type);
    }

    public function test_find_random_type_works()
    {
        $drinkType = $this->allowedDrintkTypes[array_rand($this->allowedDrintkTypes, 1)];

        $drinkFound = (new FindDrink())->find($drinkType);
        $this->assertTrue($drinkFound);
    }
}