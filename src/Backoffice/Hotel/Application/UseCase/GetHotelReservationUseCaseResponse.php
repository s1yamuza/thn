<?php

namespace THN\Backoffice\Hotel\Application\UseCase;

class GetHotelReservationUseCaseResponse
{
    private $reservation;

    public function __construct(
        array $reservation
    ) {
        $this->reservation = $reservation;
    }

    public function reservation(): array
    {
        return $this->reservation;
    }
}
