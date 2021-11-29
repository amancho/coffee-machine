<?php

namespace Adsmurai\CoffeeMachine\Orders\Domain;

interface OrderRepository
{
    public function save(Order $order): void;
    public function showMoneyByType(): array;
}