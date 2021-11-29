<?php

namespace Adsmurai\CoffeeMachine\Orders\Domain;

use Adsmurai\Shared\Domain\Collection;

class OrderCollection extends Collection
{

    protected function type(): string
    {
        return Order::class;
    }

    public static function init(): self
    {
        return new static([]);
    }

}