<?php

namespace Adsmurai\CoffeeMachine\Orders\Application\Show;

use Adsmurai\CoffeeMachine\Orders\Infraestructure\Persistence\OrderRepositoryMySql;

final class MoneyByType
{
    private OrderRepositoryMySql $repository;

    public function __construct()
    {
        $this->repository = new OrderRepositoryMySql();
    }

    public function shows(): array
    {
        return $this->repository->showMoneyByType();
    }
}