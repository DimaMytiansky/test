<?php

namespace src\io;

class StdInReader implements IReader
{
    public function read(): \Iterator
    {
        fgets(STDIN); //skip first line with headers

        $ai = new \ArrayIterator();
        while (($r = fgets(STDIN)) !== false) {
            $ai->append($r);
        }

        return $ai;
    }
}
