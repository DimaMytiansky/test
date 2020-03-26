<?php

require __DIR__ . '/vendor/autoload.php';

use src\DummyLogger;
use src\io\CsvReaderDecorator;
use src\io\CsvWriterDecorator;
use src\Linker;
use src\PeopleCollection;
use src\io\StdInReader;
use src\io\StdOutWriter;

$csvReader = new CsvReaderDecorator();
$csvReader->setReader(new StdInReader());
$csvReader->setCollection(new PeopleCollection());
$csvReader->setPositionToKeyMapping([
    0 => 'id',
    2 => 'email',
    3 => 'card',
    4 => 'phone',
]);
$writer = new StdOutWriter();
$csvWriter = new CsvWriterDecorator();
$csvWriter->setWriter($writer);

$linker = new Linker();
$linker->setReader($csvReader);
$linker->setWriter($csvWriter);
$linker->setLogger(new DummyLogger());

$linker->link();
