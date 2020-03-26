<?php

namespace src\io;

use src\ICollection;

class CsvReaderDecorator implements IReader
{
    private array $positionToKey;

    protected ICollection $collection;

    private IReader $reader;

    public function setCollection(ICollection $collection): void
    {
        $this->collection = $collection;
    }

    public function setReader(IReader $reader)
    {
        $this->reader = $reader;
    }

    public function setPositionToKeyMapping(array $positionToKey): void
    {
        $this->positionToKey = $positionToKey;
    }

    public function read(): ICollection
    {
        $csv = $this->reader->read();

        foreach ($csv as $row) {
            trim($row, '\n,');
            $row = explode(',', $row);

            $mapped = [];
            foreach ($this->positionToKey as $position => $key) {
                $mapped[$key] = $row[$position];
            }
            $this->collection->add($mapped);
        }

        return $this->collection;
    }
}
