<?php

namespace src;

abstract class Collection implements ICollection
{
    private int $key = 0;

    protected array $items = [];

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        if ($this->isEmpty() || !$this->valid()) {
            return null;
        }

        return $this->items[$this->key];
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        if ($this->isEmpty() || !$this->valid()) {
            return null;
        }

        $this->key += 1;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return $this->key() >= 0 && $this->key() < count($this->items);
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->key = 0;
    }

    /**
     * @return array all items added to the collection
     */
    public function getAll(): array
    {
        return $this->items;
    }

    /**
     * @return bool checks whether collection is empty
     */
    private function isEmpty()
    {
        return [] === $this->items;
    }
}
