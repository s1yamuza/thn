<?php

namespace THN\Tests\Backoffice\Hotel\Application\UseCase;

class HotelProviderTest
{
    public static function getOK()
    {
        return [
            "id" => "1",
            "name" => "May Ramblas Hotel Barcelona",
            "slug_name" => "may_ramblas_hotel_barcelona",
            "rooms" => "400",
            "score" => "5",
            "created_at" => "2021-06-25 18:13:07",
            "updated_at" => "2021-06-25 18:13:07"
        ];
    }

    public static function getEmpty()
    {
        return [];
    }
}
