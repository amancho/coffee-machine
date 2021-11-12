<?php

namespace Adsmurai\Apps\Console;

use Adsmurai\CoffeeMachine\Drinks\Application\Make\MakeDrink;
use Adsmurai\CoffeeMachine\Orders\Application\Create\OrderCreator;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeDrinkCommand extends Command
{
    protected static $defaultName = 'app:order-drink';
    private string $type;
    private float $money;
    private int $sugars;
    private bool $extraHot;
    private MakeDrink $drinkMaker;

    protected function configure()
    {
        $this->addArgument(
            'drink-type',
            InputArgument::REQUIRED,
            'The type of the drink. (Tea, Coffee or Chocolate)'
        );

        $this->addArgument(
            'money',
            InputArgument::REQUIRED,
            'The amount of money given by the user'
        );

        $this->addArgument(
            'sugars',
            InputArgument::OPTIONAL,
            'The number of sugars you want. (0, 1, 2)',
            0
        );

        $this->addOption(
            'extra-hot',
            'e',
            InputOption::VALUE_NONE,
            $description = 'If the user wants to make the drink extra hot'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $this->getParams($input);
            $this->makeDrink();
            $this->createOrder();

            $output->write($this->drinkMaker->message());
            $output->writeln('');

        } catch (\Exception $ex) {
            $output->writeln($ex->getMessage());
        }
    }

    private function getParams(InputInterface $input)
    {
        $this->type = strtolower($input->getArgument('drink-type'));
        $this->money = $input->getArgument('money');
        $this->sugars = $input->getArgument('sugars');
        $this->extraHot = $input->getOption('extra-hot');
    }

    private function makeDrink()
    {
        $this->drinkMaker = new MakeDrink($this->type, $this->money, $this->sugars, $this->extraHot);
        $this->drinkMaker->make();
    }

    private function createOrder()
    {
        (new OrderCreator())->create(
            $this->type,
            $this->sugars,
            $this->drinkMaker->stick(),
            $this->extraHot
        );
    }
}
