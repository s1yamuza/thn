<?php

namespace THN\Tests\Backoffice\Hotel\Application\UseCase;

use PHPUnit\Framework\TestCase;
use THN\Backoffice\Hotel\Application\Exception\ParamsNotValidException;
use THN\Backoffice\Hotel\Application\UseCase\GetHotelReservationUseCaseRequest;
use THN\Backoffice\Hotel\Application\UseCase\ListHotelUseCase;
use THN\Backoffice\Hotel\Application\UseCase\ListHotelUseCaseResponse;
use THN\Backoffice\Hotel\Infrastructure\Persistence\SQL\MySQLHotelReaderRepository;
use THN\Shared\Infrastructure\Persistence\SQL\THNPDO;
use THN\Tests\Backoffice\Hotel\Application\UseCase\HotelProviderTest;

class ListHotelUseCaseTest extends TestCase
{
    public function setUp(): void
    {
        $this->pdo = $this->createMock(THNPDO::class);

        $this->hotelRepository = new MySQLHotelReaderRepository($this->pdo);

        $this->useCase = new ListHotelUseCase(
            $this->hotelRepository
        );
    }

    /**
     * @dataProvider hotelProvider
     */
    public function testExecute($hotel)
    {
        $this->pdo->expects(self::exactly(1))->method('query')->willReturnOnConsecutiveCalls(
            [
                $hotel,
                [
                    "id" => "2",
                    "name" => "The Plaza",
                    "slug_name" => "the_plaza",
                    "rooms" => "300",
                    "score" => "0.0",
                    "created_at" => "2021-06-25 18:13:07",
                    "updated_at" => "2021-06-25 18:13:07"
                ],
                [
                    "id" => "3",
                    "name" => "Waldorf Astoria Amsterdam",
                    "slug_name" => "waldorf_astoria_amsterdam",
                    "rooms" => "500",
                    "score" => "0.0",
                    "created_at" => "2021-06-25 18:13:07",
                    "updated_at" => "2021-06-25 18:13:07"
                ]
            ]
        );

        $result = $this->useCase->execute();

        self::assertInstanceOf(ListHotelUseCaseResponse::class, $result);
        self::assertEquals(3, count($result->hotels()));
    }

    public function testExecuteResponseException()
    {
        $this->expectException(ParamsNotValidException::class);
        $requestFail = new GetHotelReservationUseCaseRequest(0);

        $this->useCase->execute($requestFail);
    }

    public function hotelProvider(): array
    {
        $hotel = HotelProviderTest::getOK();
        return [
            [
                $hotel
            ]
        ];
    }
}
