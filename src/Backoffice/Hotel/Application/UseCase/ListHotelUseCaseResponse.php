<?php

namespace THN\Backoffice\Hotel\Application\UseCase;

class ListHotelUseCaseResponse
{
    private $hotels;

    public function __construct(
        array $hotels
    ) {
        $this->hotels = $hotels;
    }

    public function hotels(): array
    {
        return $this->hotels;
    }
}
