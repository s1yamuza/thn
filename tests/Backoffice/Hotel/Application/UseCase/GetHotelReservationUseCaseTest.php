<?php

namespace THN\Tests\Backoffice\Hotel\Application\UseCase;

use PHPUnit\Framework\TestCase;
use THN\Backoffice\Hotel\Application\Exception\ParamsNotValidException;
use THN\Backoffice\Hotel\Application\UseCase\GetHotelReservationUseCase;
use THN\Backoffice\Hotel\Application\UseCase\GetHotelReservationUseCaseRequest;
use THN\Backoffice\Hotel\Application\UseCase\GetHotelReservationUseCaseResponse;
use THN\Backoffice\Hotel\Infrastructure\Persistence\SQL\MySQLHotelReaderRepository;
use THN\Shared\Domain\Hotel\Room;
use THN\Shared\Infrastructure\Persistence\SQL\THNPDO;

class GetHotelReservationUseCaseTest extends TestCase
{
    public function setUp(): void
    {
        $this->pdo = $this->createMock(THNPDO::class);

        $this->hotelRepository = new MySQLHotelReaderRepository($this->pdo);

        $this->request = new GetHotelReservationUseCaseRequest(1);

        $this->useCase = new GetHotelReservationUseCase(
            $this->hotelRepository
        );

        $this->room = new Room(320);
        $this->room2 = new Room(301);
    }

    /**
     * @dataProvider reservationProvider
     */
    public function testExecute($reservation)
    {
        $this->pdo->expects(self::exactly(1))->method('query')->willReturnOnConsecutiveCalls(
            [
                $reservation,
                [
                    'id' => 2,
                    'room_number' => 120,
                    'hotel_name' => 'May Ramblas Hotel Barcelona',
                    'user_name' => 'Walter White',
                ]
            ]
        );

        $result = $this->useCase->execute($this->request);

        self::assertInstanceOf(GetHotelReservationUseCaseResponse::class, $result);
        self::assertEquals(2, count($result->reservation()));

        self::assertTrue($this->room->isEqualto($this->room));
        self::assertFalse($this->room->isEqualto($this->room2));
    }

    public function testExecuteResponseException()
    {
        $this->expectException(ParamsNotValidException::class);
        $requestFail = new GetHotelReservationUseCaseRequest(0);

        $this->useCase->execute($requestFail);
    }

    public function reservationProvider(): array
    {
        $reservation = ReservationProviderTest::getOK();
        return [
            [
                $reservation
            ]
        ];
    }
}
