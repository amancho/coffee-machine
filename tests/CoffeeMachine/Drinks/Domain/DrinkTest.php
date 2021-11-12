<?php

namespace Adsmurai\Tests\CoffeeMachine\Drinks\Domain;

use Adsmurai\CoffeeMachine\Drinks\Domain\Drink;
use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkId;
use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkName;
use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkPrice;
use PHPUnit\Framework\TestCase;

class DrinkTest extends TestCase
{

    public function test_drink_works()
    {
        $id = 1;
        $name= 'coffee';

        $drink = Drink::create(
            new DrinkId($id),
            new DrinkName($name),
            new DrinkPrice($name)
        );

        $this->assertInstanceOf(Drink::class, $drink);
        $this->assertIsInt($drink->id()->value());
        $this->assertIsString($drink->name()->value());
        $this->assertIsFloat($drink->price()->value());

        $this->assertEquals($drink->id()->value(), $id);
        $this->assertEquals($drink->name()->value(), $name);
    }
}