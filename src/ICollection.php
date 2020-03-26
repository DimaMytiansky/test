<?php

namespace src;

use Iterator;

interface ICollection extends Iterator
{
    public function getAll(): array;

    public function add(array $item);

    public function sortById();
}
