<?php

namespace THN\Backoffice\Hotel\Infrastructure\Factory;

use THN\Backoffice\Hotel\Domain\Hotel;
use THN\Backoffice\Hotel\Domain\HotelFactory;

class MySQLHotelFactory extends HotelFactory
{
    public function createFromResultSet($dataHotels): array
    {
        return array_map(
            function ($hotel) {
                return $this->createFromRow($hotel);
            },
            $dataHotels
        );
    }

    public function createFromRow($hotel): Hotel
    {
        return $this->create(
            $hotel['id'],
            $hotel['name'],
            $hotel['slug_name'],
            $hotel['rooms'],
            $hotel['score'],
            $hotel['created_at'],
            $hotel['updated_at']
        );
    }
}
