<?php

namespace Adsmurai\CoffeeMachine\Drinks\Domain;

use Adsmurai\Shared\Domain\DomainError;

final class DrinkNotFound extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'drink_not_found';
    }

    protected function errorMessage(): string
    {
        return 'The drink type should be tea, coffee or chocolate.';
    }
}