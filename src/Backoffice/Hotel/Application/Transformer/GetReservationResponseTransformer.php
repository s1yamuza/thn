<?php

namespace THN\Backoffice\Hotel\Application\Transformer;

use THN\Backoffice\Hotel\Domain\Hotel;
use THN\Backoffice\Hotel\Domain\Reservation;

class GetReservationResponseTransformer
{
    public function transform(Reservation ...$reservations): array
    {
        return array_map(static function (Reservation $reservation) {
            return [
                'id' => $reservation->id(),
                'roomNumber' => $reservation->room()->value(),
                'has_terrace' => $reservation->room()->hasTerrace(),
                'hotel_name' => $reservation->hotelName(),
                'user_name' => $reservation->userName()
            ];
        }, $reservations);
    }
}
