<?php

namespace Adsmurai\CoffeeMachine\Orders\Application\Create;

use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkPrice;
use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkType;
use Adsmurai\CoffeeMachine\Orders\Domain\Order;
use Adsmurai\CoffeeMachine\Orders\Domain\OrderExtraHot;
use Adsmurai\CoffeeMachine\Orders\Domain\OrderStick;
use Adsmurai\CoffeeMachine\Orders\Domain\OrderSugar;
use Adsmurai\CoffeeMachine\Orders\Infraestructure\Persistence\OrderRepositoryMySql;
use Adsmurai\Shared\Infraestructure\Persistence\MySql\MySqlRepository;
use PDO;

class OrderCreator
{
    private OrderRepositoryMySql $orderRepository;
    private PDO $repository;

    public function __construct()
    {
        $this->repository = MySqlRepository::getClient();
        $this->orderRepository = new OrderRepositoryMySql($this->repository);
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

        $this->orderRepository->save($order);
    }
}