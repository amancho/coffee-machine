#!/usr/bin/env php
<?php
// application.php

require __DIR__.'/vendor/autoload.php';

use Adsmurai\Apps\Console\MakeDrinkCommand;
use Adsmurai\Apps\Console\ShowOrdersByMoneyCommand;
use Adsmurai\Apps\Console\ShowOrdersCommand;
use Symfony\Component\Console\Application;

$application = new Application();


$application->add(new ShowOrdersByMoneyCommand());
$application->add(new ShowOrdersCommand());

$application->add(new MakeDrinkCommand());

$application->run();
