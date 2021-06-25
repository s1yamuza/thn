<?php

namespace THN\Backoffice\Hotel\Domain;

interface HotelFactoryInterface
{
    public function create(
        int $id,
        string $name,
        string $slugName,
        int $rooms,
        float $score,
        string $createdAt,
        string $updatedAt
    ): Hotel;
}
