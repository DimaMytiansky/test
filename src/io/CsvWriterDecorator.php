<?php

namespace src\io;

class CsvWriterDecorator implements IWriter
{
    private IWriter $writer;

    public function setWriter(IWriter $writer)
    {
        $this->writer = $writer;
    }

    public function write($data): void
    {
        $this->writer->write(implode(',', $data) . PHP_EOL);
    }
}
