<?php

namespace src;

class PeopleCollection extends Collection
{
    /**
     * Adds people to the collection
     *
     * @param array $personData
     */
    public function add(array $personData): void
    {
        $this->items[] = $this->makePerson($personData);
    }

    public function sortById()
    {
        usort($this->items, function (Person $a, Person $b) {
            return $a->getId() > $b->getId();
        });
    }

    /**
     * Converts raw data to Person object
     * @param array $data
     *
     * @return Person
     */
    private function makePerson(array $data): Person
    {
        return (new Person())
            ->setId((int)$data['id'])
            ->setCard($data['card'])
            ->setEmail($data['email'])
            ->setPhone($data['phone']);
    }
}
