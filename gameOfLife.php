#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use app\GameCommand;

$application = new Application();
$gameCommand = new GameCommand();
$application->add($gameCommand);
$application->setDefaultCommand($gameCommand->getName());
$application->run();