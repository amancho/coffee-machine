<?php

namespace Adsmurai\CoffeeMachine\Drinks\Application\Make;

use Adsmurai\CoffeeMachine\Drinks\Application\Find\FindDrink;

final class MakeDrink
{
    private string $message;
    private string $type;
    private float $money;
    private int $sugars;
    private bool $extraHot;
    private bool $stick = false;

    public function __construct(string $type, float $money, int $sugars, bool $extraHot)
    {
        $this->type = $type;
        $this->money = $money;
        $this->sugars = $sugars;
        $this->extraHot = $extraHot;
    }

    /**
     * Make a drink with previous checks
     */
    public function make()
    {
        $this->checkType();
        $this->checkMoney();
        $this->checkSugar();
        $this->setMessage();
    }

    private function checkType()
    {
        (new FindDrink())->find($this->type);
    }

    private function checkSugar()
    {
        (new SugarCheckDrink())->check($this->sugars);
    }

    public function checkMoney()
    {
        (new MoneyCheckDrink())->check($this->type, $this->money);
    }

    private function setMessage()
    {
        $this->message = 'You have ordered a ' . $this->type;
        if ($this->extraHot) {
            $this->message .= ' extra hot';
        }

        if ($this->sugars > 0) {
            $this->stick = true;
            $this->message .= ' with ' . $this->sugars . ' sugars (stick included)';
        }
    }

    public function message(): string
    {
        return $this->message;
    }

    public function stick(): bool
    {
        return $this->stick;
    }

}