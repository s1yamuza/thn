<?php

namespace THN\Backoffice\Hotel\Application\UseCase;

use THN\Backoffice\Hotel\Application\Exception\ParamsNotValidException;

class GetHotelReservationUseCaseRequest
{
    private $hotelId;

    public function __construct(
        int $hotelId
    ) {
        $this->setHotelId($hotelId);
    }

    public function hotelId(): int
    {
        return $this->hotelId;
    }

    private function setHotelId(int $hotelId): void
    {
        if (empty($hotelId)) {
            throw new ParamsNotValidException();
        }
        $this->hotelId = $hotelId;
    }
}
