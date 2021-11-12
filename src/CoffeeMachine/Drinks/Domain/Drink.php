<?php

namespace Adsmurai\CoffeeMachine\Drinks\Domain;

final class Drink
{
    private DrinkId $id;
    private DrinkName $name;
    private DrinkPrice $price;

    public function __construct(DrinkId $id, DrinkName $name, DrinkPrice $price
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * @param DrinkId $id
     * @param DrinkName $name
     * @param DrinkPrice $price
     * @return Drink
     */
    public static function create(
        DrinkId $id,
        DrinkName $name,
        DrinkPrice $price
    ): Drink {
        return new self($id, $name, $price);
    }

    public function id(): DrinkId
    {
        return $this->id;
    }

    public function name(): DrinkName
    {
        return $this->name;
    }

    public function price(): DrinkPrice
    {
        return $this->price;
    }

}
