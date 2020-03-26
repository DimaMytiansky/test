<?php

namespace src;

use Psr\Log\LoggerInterface;
use src\io\FileNotFoundException;
use src\io\IReader;
use src\io\IWriter;

class Linker
{
    private IWriter $writer;
    private IReader $reader;
    private LoggerInterface $logger;

    public function link(): void
    {
        $emailToMinId = [];
        $phoneToMinId = [];
        $cardToMinId = [];

        try {
            /** @var PeopleCollection $collection */
            $collection = $this->reader->read();
        } catch (FileNotFoundException $e) {
            $this->logger->log('error', $e->getMessage());
        }

        $collection->sortById();

        $this->writer->write(['ID', 'PARENT_ID']);
        /** @var Person $person */
        foreach ($collection as $person) {
            $currentMinId = $person->getId();
            if (!empty($emailToMinId[$person->getEmail()])) {
                $currentMinId = min($currentMinId, $emailToMinId[$person->getEmail()]);
            }
            if (!empty($cardToMinId[$person->getCard()])) {
                $currentMinId = min($currentMinId, $cardToMinId[$person->getCard()]);
            }
            if (!empty($phoneToMinId[$person->getPhone()])) {
                $currentMinId = min($currentMinId, $phoneToMinId[$person->getPhone()]);
            }

            $emailToMinId[$person->getEmail()] = $currentMinId;
            $cardToMinId[$person->getCard()] = $currentMinId;
            $phoneToMinId[$person->getPhone()] = $currentMinId;

            $this->writer->write([$person->getId(), $currentMinId]);
        }
    }

    public function setWriter(IWriter $writer): void
    {
        $this->writer = $writer;
    }

    public function setReader(IReader $reader): void
    {
        $this->reader = $reader;
    }

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }
}
