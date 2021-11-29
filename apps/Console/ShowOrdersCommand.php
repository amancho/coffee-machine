<?php

namespace Adsmurai\Apps\Console;

use Adsmurai\CoffeeMachine\Orders\Application\Show\GetOrdersHandler;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ShowOrdersCommand extends Command
{
    protected static $defaultName = 'app:show-orders';
    private array $orders;

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->getOrders();
            $this->showReport($output);
        } catch (\Exception $ex) {
            $output->writeln($ex->getMessage());
        }
    }

    private function getOrders()
    {
        $this->orders = (new GetOrdersHandler())->shows();
        if (empty($this->orders)) {
            throw new Exception('Nothing to show, empty orders');
        }
    }

    private function showReport(OutputInterface $output)
    {
        $output->writeln('Drink      | Price | Sugar | Stick | E.Hot');
        $output->writeln('------------------------------------------- ');

        foreach($this->orders as $order){
            $output->writeln($this->getType($order['drink_type'])
                . ' | ' . $this->getMoney($order['price'])
                . ' | ' . $order['sugars'] . '    '
                . ' | ' . $order['stick'] . '    '
                . ' | ' . $order['extra_hot']
            );
        }
    }

    private function getType(string $type): string
    {
        return (string) substr($type . '        ', 0, 10);
    }

    private function getMoney(string $money): string
    {
        return round($money, 2) . '€ ';
    }
}
