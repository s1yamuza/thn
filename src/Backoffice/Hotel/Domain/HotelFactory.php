<?php

namespace THN\Backoffice\Hotel\Domain;

use THN\Backoffice\Hotel\Domain\Hotel;

class HotelFactory implements HotelFactoryInterface
{
    public function create(
        int $id,
        string $name,
        string $slugName,
        int $rooms,
        float $score,
        string $createdAt,
        string $updatedAt
    ): Hotel {
        return new Hotel(
            $id,
            $name,
            $slugName,
            $rooms,
            $score,
            $createdAt,
            $updatedAt
        );
    }
}
