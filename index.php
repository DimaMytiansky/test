<?php

use src\Container;
use src\Linker;

require __DIR__ . '/vendor/autoload.php';
$config = require __DIR__ . '/config.php';

try {
    /** @var Linker $linker */
    $linker = Container::create($config)->get(Linker::class);
    $linker->link();
} catch (\Exception $e) {
    die($e->getMessage());
}
