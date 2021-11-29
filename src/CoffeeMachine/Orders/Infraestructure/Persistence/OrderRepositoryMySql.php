<?php

namespace Adsmurai\CoffeeMachine\Orders\Infraestructure\Persistence;

use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkPrice;
use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkType;
use Adsmurai\CoffeeMachine\Orders\Domain\Order;
use Adsmurai\CoffeeMachine\Orders\Domain\OrderCollection;
use Adsmurai\CoffeeMachine\Orders\Domain\OrderExtraHot;
use Adsmurai\CoffeeMachine\Orders\Domain\OrderPrice;
use Adsmurai\CoffeeMachine\Orders\Domain\OrderRepository;
use Adsmurai\CoffeeMachine\Orders\Domain\OrderStick;
use Adsmurai\CoffeeMachine\Orders\Domain\OrderSugar;
use PDO;

final class OrderRepositoryMySql implements OrderRepository
{
    private PDO $client;

    public function __construct(PDO $client)
    {
        $this->client = $client;
    }

    public function save(Order $order): void
    {
        $stmt = $this->client->prepare('INSERT INTO orders (drink_type, price, sugars, stick, extra_hot) VALUES (:drink_type, :price, :sugars, :stick, :extra_hot)');
        $stmt->execute($this->toInfrastructure($order));
    }

    public function showMoneyByType(): array
    {
        $stmt = $this->client->query('SELECT drink_type, SUM(price) AS `money` FROM orders GROUP BY drink_type');
        return $stmt->fetchAll();
    }

    public function show(): OrderCollection
    {
        $stmt = $this->client->query('SELECT * FROM orders');
        $orders = $stmt->fetchAll();

        $orderCollection = OrderCollection::init();

        if (!empty($orders)) {
            foreach ($orders as $order) {
                $orderCollection->add($this->toDomain($order));
            }
        }

        return $orderCollection;
    }

    private function toInfrastructure(Order $order): array
    {
        return [
            'drink_type' => $order->type()->value(),
            'price' => $order->price()->value(),
            'sugars' => $order->sugar()->value(),
            'stick' => $order->stick()->value() ?: 0,
            'extra_hot' => $order->extraHot()->value() ?: 0,
        ];
    }

    private function toDomain(array $order): Order
    {
        return new Order(
            new DrinkType($order['drink_type']),
            new OrderPrice((new DrinkPrice($order['drink_type']))->value()),
            new OrderSugar($order['sugars']),
            new OrderStick($order['stick']),
            new OrderExtraHot($order['extra_hot'])
        );
    }
}