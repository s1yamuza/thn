<?php

namespace THN\Backoffice\Hotel\Domain;

use THN\Shared\Domain\Hotel\Room;

interface ReservationFactoryInterface
{
    public function create(
        int $id,
        int $room,
        string $hotelName,
        string $userName
    ): Reservation;
}
