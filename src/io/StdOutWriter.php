<?php

namespace src\io;

class StdOutWriter implements IWriter
{
    public function write($data): void
    {
        fputs(STDOUT, $data);
    }
}
