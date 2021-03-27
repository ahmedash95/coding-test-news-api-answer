<?php

use App\NewsAggregator;
use App\Repositories\BrokenProviderRepository;
use App\Repositories\FoxNewsRepository;
use App\Repositories\NYTimesRepository;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require __DIR__.DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";

$output = "[%datetime%] %channel%.%level_name%: %message% %context.user%\n";
$formatter = new LineFormatter($output);

$logger = new Logger('News API');
$errorStream = new StreamHandler(__DIR__.DIRECTORY_SEPARATOR.'app-errors.log', Logger::ERROR);
$errorStream->setFormatter($formatter);
$logger->pushHandler($errorStream);

$aggregator = new NewsAggregator($logger);
$aggregator->addProvider(new NYTimesRepository());
$aggregator->addProvider(new FoxNewsRepository());
$aggregator->addProvider(new BrokenProviderRepository());
$news = $aggregator->get();

print_r($news);