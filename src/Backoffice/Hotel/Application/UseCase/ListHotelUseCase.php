<?php

namespace THN\Backoffice\Hotel\Application\UseCase;

use THN\Backoffice\Hotel\Domain\HotelReaderRepositoryInterface;

class ListHotelUseCase
{
    private $hotelReaderRepository;

    public function __construct(
        HotelReaderRepositoryInterface $hotelReaderRepository
    ) {
        $this->hotelReaderRepository = $hotelReaderRepository;
    }

    public function execute()
    {
        $hotels = $this->hotelReaderRepository->list();

        return new ListHotelUseCaseResponse($hotels);
    }
}
