<?php

namespace Adsmurai\Tests\CoffeeMachine\Drinks\Domain;

use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkNotFound;
use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkPrice;

use PHPUnit\Framework\TestCase;

class DrinkPriceTest extends TestCase
{
    public function test_drink_price_test_fails()
    {
        $this->expectException(DrinkNotFound::class);
        new DrinkPrice('test');
    }

    public function test_drink_price_test_works()
    {
        $types = ['tea', 'coffee', 'chocolate'];

        foreach($types as $type){
            $drinkPrice = new DrinkPrice($type);
            $this->assertInstanceOf(DrinkPrice::class, $drinkPrice);
            $this->assertIsFloat($drinkPrice->value());
            $this->assertGreaterThanOrEqual(0.4, $drinkPrice->value());
        }
    }
}