<?php

namespace THN\Tests\Backoffice\Hotel\Application\Transformer;

use PHPUnit\Framework\TestCase;
use THN\Backoffice\Hotel\Application\Transformer\ListHotelResponseTransformer;
use THN\Backoffice\Hotel\Domain\Hotel;
use THN\Backoffice\Hotel\Infrastructure\Factory\MySQLHotelFactory;
use THN\Tests\Backoffice\Hotel\Application\UseCase\HotelProviderTest;

class ListHotelResponseTransformerTest extends TestCase
{
    private $transformer;
    private $entityHotel;
    private $responseTransformer;

    public function setUp(): void
    {
        $factory = new MySQLHotelFactory();
        $hotelData = [
            HotelProviderTest::getOK()
        ];
        $this->entityHotel = $factory->createFromResultSet($hotelData);
        $this->transformer = new ListHotelResponseTransformer();

        $this->responseTransformer = array_map(static function (Hotel $r) {
            return [
                'id' => $r->id(),
                'name' => $r->name(),
                'slug_name' => $r->slugName(),
                'rooms' => $r->rooms(),
                'score' => $r->score()
            ];
        }, $this->entityHotel);
    }

    public function testTransform()
    {
        $result = $this->transformer->transform(... $this->entityHotel);
        $this->assertEquals($this->responseTransformer, $result);
    }
}
