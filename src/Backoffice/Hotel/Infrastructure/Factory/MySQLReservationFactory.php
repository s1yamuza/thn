<?php

namespace THN\Backoffice\Hotel\Infrastructure\Factory;

use THN\Backoffice\Hotel\Domain\Reservation;
use THN\Backoffice\Hotel\Domain\ReservationFactory;

class MySQLReservationFactory extends ReservationFactory
{
    public function createFromResultSet($dataReservation): array
    {
        return array_map(
            function ($reservation) {
                return $this->createFromRow($reservation);
            },
            $dataReservation
        );
    }

    public function createFromRow($reservation): Reservation
    {
        return $this->create(
            $reservation['id'],
            $reservation['room_number'],
            $reservation['hotel_name'],
            $reservation['user_name']
        );
    }
}
