<?php

//require __DIR__.'/../../../vendor/autoload.php';

//require "CreateDbCommand.php";

use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new CreateDbCommand());
$application->add(new AddFeedCommand());
$application->add(new ListFeedCommand());
$application->add(new RemoveFeedCommand());

$application->run();