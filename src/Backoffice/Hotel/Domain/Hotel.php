<?php

namespace THN\Backoffice\Hotel\Domain;

class Hotel
{
    private $id;
    private $name;
    private $slugName;
    private $rooms;
    private $score;
    private $createdAt;
    private $updatedAt;

    public function __construct(
        int $id,
        string $name,
        string $slugName,
        int $rooms,
        float $score,
        string $createdAt,
        string $updatedAt
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->slugName = $slugName;
        $this->rooms = $rooms;
        $this->score = $score;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function slugName(): string
    {
        return $this->slugName;
    }

    public function rooms(): int
    {
        return $this->rooms;
    }

    public function score(): float
    {
        return $this->score;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    public function updatedAt(): string
    {
        return $this->updatedAt;
    }
}
