<?php

namespace THN\Backoffice\Hotel\Domain;

use THN\Backoffice\Hotel\Domain\Reservation;

class ReservationFactory implements ReservationFactoryInterface
{
    public function create(
        int $id,
        int $room,
        string $hotelName,
        string $userName
    ): Reservation {
        return new Reservation(
            $id,
            $room,
            $hotelName,
            $userName
        );
    }
}
