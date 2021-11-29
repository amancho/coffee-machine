<?php

namespace Adsmurai\Tests\CoffeeMachine\Orders\Domain;

use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkPrice;
use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkType;
use Adsmurai\CoffeeMachine\Orders\Domain\Order;
use Adsmurai\CoffeeMachine\Orders\Domain\OrderExtraHot;
use Adsmurai\CoffeeMachine\Orders\Domain\OrderPrice;
use Adsmurai\CoffeeMachine\Orders\Domain\OrderStick;
use Adsmurai\CoffeeMachine\Orders\Domain\OrderSugar;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{

    public function test_order_works()
    {
        $type = 'coffee';

        $order = Order::create(
            new DrinkType($type),
            new OrderPrice((new DrinkPrice($type))->value()),
            new OrderSugar(1),
            new OrderStick(true),
            new OrderExtraHot(false),
        );

        $this->assertInstanceOf(Order::class, $order);
        $this->assertIsString($order->type()->value());
        $this->assertIsFloat($order->price()->value());

        $this->assertEquals($order->type()->value(), $type);
        $this->assertTrue($order->stick()->value());
        $this->assertfalse($order->extraHot()->value());
    }
}