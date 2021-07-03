<?php

namespace THN\Tests\Backoffice\Hotel\Application\Transformer;

use PHPUnit\Framework\TestCase;
use THN\Backoffice\Hotel\Application\Transformer\GetReservationResponseTransformer;
use THN\Backoffice\Hotel\Domain\Reservation;
use THN\Backoffice\Hotel\Infrastructure\Factory\MySQLReservationFactory;
use THN\Tests\Backoffice\Hotel\Application\UseCase\ReservationProviderTest;

class GetReservationResponseTransformerTest extends TestCase
{
    private $transformer;
    private $entityReservation;
    private $responseTransformer;

    public function setUp(): void
    {
        $factory = new MySQLReservationFactory();
        $reservationData = [
            ReservationProviderTest::getOK()
        ];
        $this->entityReservation = $factory->createFromResultSet($reservationData);
        $this->transformer = new GetReservationResponseTransformer();

        $this->responseTransformer = array_map(static function (Reservation $r) {
            return [
                'id' => $r->id(),
                'room_number' => $r->room()->value(),
                'hotel_name' => $r->hotelName(),
                'user_name' => $r->userName(),
                'has_terrace' => $r->room()->hasTerrace()
            ];
        }, $this->entityReservation);
    }

    public function testTransform()
    {
        $result = $this->transformer->transform(... $this->entityReservation);
        $this->assertEquals($this->responseTransformer, $result);
    }
}
