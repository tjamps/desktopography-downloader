#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;
use Desktopography\Command\Download;

$application = new Application('desktopography', '1.0');
$command = new Download();

$application->add($command);
$application->setDefaultCommand($command->getName(), true);

$application->run();
