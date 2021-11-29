<?php

namespace Adsmurai\Apps\Console;

use Adsmurai\CoffeeMachine\Orders\Application\Show\GetOrdersByMoneyHandler;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowOrdersByMoneyCommand extends Command
{
    protected static $defaultName = 'app:show-orders-by-money';
    private array $types;

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->getOrdersByMoney();
            $this->showReport($output);
        } catch (\Exception $ex) {
            $output->writeln($ex->getMessage());
        }
    }

    private function getOrdersByMoney()
    {
        $this->types = (new GetOrdersByMoneyHandler())->show();
        if (empty($this->types)) {
            throw new Exception('Nothing to show, empty orders');
        }
    }

    private function showReport(OutputInterface $output)
    {
        $output->writeln('Drink      | Money');
        $output->writeln('-------------------');

        foreach($this->types as $type){
            $output->writeln($this->getType($type['drink_type']) . ' | ' . $this->getMoney($type['money']));
        }
    }

    private function getType(string $type): string
    {
        return (string) substr($type . '        ', 0, 10);
    }

    private function getMoney(string $money): string
    {
        return round($money, 2) . '€';
    }
}
