<?php

namespace THN\Tests\Backoffice\Hotel\Application\UseCase;

use THN\Shared\Domain\Hotel\Room;

class ReservationProviderTest
{
    public static function getOK()
    {
        return [
            'id' => 1,
            'room_number' => 320,
            'hotel_name' => 'May Ramblas Hotel Barcelona',
            'user_name' => 'Saul Goodman'
        ];
    }

    public static function getEmpty()
    {
        return [];
    }
}
