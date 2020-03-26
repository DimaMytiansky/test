<?php

namespace src\io;

class FileReader implements IReader
{
    protected string $path;

    public function setFilePath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @param string $path
     *
     * @return resource
     * @throws FileNotFoundException
     */
    protected function openFile(string $path)
    {
        $f = fopen($path, 'r');

        if (false === $f) {
            throw new FileNotFoundException('Can not open file ' . $path);
        }

        return $f;
    }

    protected function closeFile($f): void
    {
        fclose($f);
    }

    /**
     * @return \Iterator
     * @throws FileNotFoundException
     */
    public function read(): \Iterator
    {
        $f = $this->openFile($this->path);

        fgets($f); //skip first line with headers

        $ai = new \ArrayIterator();
        while (($r = fgets($f)) !== false) {
            $ai->append($r);
        }
        $this->closeFile($f);

        return $ai;
    }
}
