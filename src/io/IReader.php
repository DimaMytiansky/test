<?php

namespace src\io;

interface IReader
{
    public function read(): \Iterator;
}
