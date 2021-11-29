<?php

namespace Adsmurai\CoffeeMachine\Orders\Infraestructure\Persistence;

use Adsmurai\CoffeeMachine\Orders\Domain\Order;
use Adsmurai\CoffeeMachine\Orders\Domain\OrderRepository;
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
        $stmt->execute([
            'drink_type' => $order->type()->value(),
            'price' => $order->price()->value(),
            'sugars' => $order->sugar()->value(),
            'stick' => $order->stick()->value() ?: 0,
            'extra_hot' => $order->extraHot()->value() ?: 0,
        ]);
    }

    public function showMoneyByType(): array
    {
        $stmt = $this->client->query('SELECT drink_type, SUM(price) AS `money` FROM orders GROUP BY drink_type');
        return $stmt->fetchAll();
    }
}