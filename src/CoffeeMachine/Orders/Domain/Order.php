<?php

namespace Adsmurai\CoffeeMachine\Orders\Domain;

use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkPrice;
use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkType;

final class Order
{
    private DrinkType $type;
    private DrinkPrice $price;
    private OrderSugar $sugar;
    private OrderStick $stick;
    private OrderExtraHot $extraHot;

    public function __construct(DrinkType $type, DrinkPrice $price, OrderSugar $sugar, OrderStick $stick, OrderExtraHot $extraHot
    ) {
        $this->type = $type;
        $this->price = $price;
        $this->sugar = $sugar;
        $this->stick = $stick;
        $this->extraHot = $extraHot;
    }

    /**
     * Create new order instance
     *
     * @param DrinkType $type
     * @param DrinkPrice $price
     * @param OrderSugar $sugar
     * @param OrderStick $stick
     * @param OrderExtraHot $extraHot
     * @return Order
     */
    public static function create(
        DrinkType $type,
        DrinkPrice $price,
        OrderSugar $sugar,
        OrderStick $stick,
        OrderExtraHot $extraHot
    ): Order {
        return new self($type, $price, $sugar, $stick, $extraHot);
    }

    public function type(): DrinkType
    {
        return $this->type;
    }

    public function sugar(): OrderSugar
    {
        return $this->sugar;
    }

    public function stick(): OrderStick
    {
        return $this->stick;
    }

    public function extraHot(): OrderExtraHot
    {
        return $this->extraHot;
    }

    public function price(): DrinkPrice
    {
        return $this->price;
    }
}
