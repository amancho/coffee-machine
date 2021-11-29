<?php

namespace Adsmurai\CoffeeMachine\Orders\Domain;

use Adsmurai\CoffeeMachine\Drinks\Domain\DrinkType;

final class Order
{
    private DrinkType $type;
    private OrderPrice $price;
    private OrderSugar $sugar;
    private OrderStick $stick;
    private OrderExtraHot $extraHot;

    public function __construct(DrinkType $type, OrderPrice $price, OrderSugar $sugar, OrderStick $stick, OrderExtraHot $extraHot
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
     * @param OrderPrice $price
     * @param OrderSugar $sugar
     * @param OrderStick $stick
     * @param OrderExtraHot $extraHot
     * @return Order
     */
    public static function create(
        DrinkType $type,
        OrderPrice $price,
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

    public function price(): OrderPrice
    {
        return $this->price;
    }

    public function toArray()
    {
        return [
            'drink_type' => $this->type()->value(),
            'price' => $this->price()->value(),
            'sugars' => $this->sugar()->value(),
            'stick' => $this->stick()->value() ?: 0,
            'extra_hot' => $this->extraHot()->value() ?: 0,
        ];
    }
}
