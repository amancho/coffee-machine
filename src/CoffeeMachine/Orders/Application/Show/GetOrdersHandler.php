<?php

namespace Adsmurai\CoffeeMachine\Orders\Application\Show;

use Adsmurai\CoffeeMachine\Orders\Application\Response\OrderCollectionResponse;
use Adsmurai\CoffeeMachine\Orders\Infraestructure\Persistence\OrderRepositoryMySql;
use Adsmurai\Shared\Infraestructure\Persistence\MySql\MySqlRepository;
use PDO;

class GetOrdersHandler
{
    private OrderRepositoryMySql $orderRepository;
    private PDO $repository;

    public function __construct()
    {
        $this->repository = MySqlRepository::getClient();
        $this->orderRepository = new OrderRepositoryMySql($this->repository);
    }

    public function shows(): array
    {
        $orderCollection = $this->orderRepository->show();
        return (new OrderCollectionResponse($orderCollection))->toArray();
    }

}