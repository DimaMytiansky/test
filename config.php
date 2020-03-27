<?php
return [
    \src\Linker::class => [
        'dependencies' => [
            'reader' => \src\io\CsvReaderDecorator::class,
            'writer' => \src\io\CsvWriterDecorator::class,
            'logger' => \src\DummyLogger::class,
        ]
    ],
    \src\io\CsvReaderDecorator::class => [
        'dependencies' => [
            'reader' => \src\io\StdInReader::class,
            'collection' => \src\PeopleCollection::class,
            'positionToKeyMapping' => [
                0 => 'id',
                2 => 'email',
                3 => 'card',
                4 => 'phone',
            ]
        ]
    ],
    \src\io\CsvWriterDecorator::class => [
        'dependencies' => [
            'writer' => \src\io\StdOutWriter::class,
        ]
    ],
];