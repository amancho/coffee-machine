<?php

namespace Adsmurai\CoffeeMachine\Drinks\Domain;

use Adsmurai\Shared\Domain\DomainError;

final class DrinkIncorrectSugar extends DomainError
{
    public function __construct()
    {
        parent::__construct();
    }

    public function errorCode(): string
    {
        return 'drink_incorrect_sugars';
    }

    protected function errorMessage(): string
    {
        return 'The number of sugars should be between 0 and 2.';
    }
}