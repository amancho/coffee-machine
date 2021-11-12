<?php

namespace Adsmurai\CoffeeMachine\Drinks\Domain;

use Adsmurai\Shared\Domain\Collection;

final class Drinks extends Collection
{
    protected function type(): string
    {
        return Drink::class;
    }
}