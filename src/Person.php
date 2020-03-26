<?php

namespace src;

class Person
{
    private int $id;

    private int $parentId;

    private string $email;

    private string $card;

    private string $phone;

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): Person
    {
        $this->phone = $phone;

        return $this;
    }

    public function getCard(): string
    {
        return $this->card;
    }

    public function setCard(string $card): Person
    {
        $this->card = $card;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): Person
    {
        $this->email = $email;

        return $this;
    }

    public function setParentId(int $parentId): Person
    {
        $this->parentId = $parentId;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Person
    {
        $this->id = $id;

        return $this;
    }
}
