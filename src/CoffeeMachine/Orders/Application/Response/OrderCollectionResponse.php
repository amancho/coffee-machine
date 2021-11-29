<?php

namespace Adsmurai\CoffeeMachine\Orders\Application\Response;

use Adsmurai\CoffeeMachine\Orders\Domain\OrderCollection;

class OrderCollectionResponse
{
    private array $orders;

    public function __construct(OrderCollection $orderCollection)
    {
        $this->orders = [];
        foreach ($orderCollection->getCollection() as $order) {
            $this->orders[] = $order;
        }
    }

    public function orders(): array
    {
        return $this->orders;
    }

    public function toArray(): array
    {
        return array_map(function ($order) {
            return $order->toArray();
        }, $this->orders());
    }
}