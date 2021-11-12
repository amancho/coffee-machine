<?php

namespace Adsmurai\CoffeeMachine\Orders\Application\Create;

use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkPrice;
use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkType;
use Adsmurai\CoffeeMachine\Orders\Domain\Order;
use Adsmurai\CoffeeMachine\Orders\Domain\OrderExtraHot;
use Adsmurai\CoffeeMachine\Orders\Domain\OrderStick;
use Adsmurai\CoffeeMachine\Orders\Domain\OrderSugar;
use Adsmurai\CoffeeMachine\Orders\Infraestructure\Persistence\OrderRepositoryMySql;

class OrderCreator
{
    private OrderRepositoryMySql $repository;

    public function __construct()
    {
        $this->repository = new OrderRepositoryMySql();
    }

    public function create(string $type, int $sugar, bool $stick, bool $orderExtraHot): void
    {
        $order = Order::create(
            new DrinkType($type),
            new DrinkPrice($type),
            new OrderSugar($sugar),
            new OrderStick($stick),
            new OrderExtraHot($orderExtraHot)
        );

        $this->repository->save($order);
    }
}