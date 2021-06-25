<?php

namespace THN\Backoffice\Hotel\Application\UseCase;

use THN\Backoffice\Hotel\Domain\HotelReaderRepositoryInterface;

class GetHotelReservationUseCase
{
    private $hotelReaderRepository;

    public function __construct(
        HotelReaderRepositoryInterface $hotelReaderRepository
    ) {
        $this->hotelReaderRepository = $hotelReaderRepository;
    }

    public function execute(GetHotelReservationUseCaseRequest $request)
    {
        $reservations = $this->hotelReaderRepository->reservation($request->hotelId());

        return new GetHotelReservationUseCaseResponse($reservations);
    }
}
