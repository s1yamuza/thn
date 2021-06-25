<?php

namespace THN\Backoffice\Hotel\Application\Transformer;

use THN\Backoffice\Hotel\Domain\Hotel;

class ListHotelResponseTransformer
{
    public function transform(Hotel ...$hotels): array
    {
        return array_map(static function (Hotel $hotel) {
            return [
                'id' => $hotel->id(),
                'name' => $hotel->name(),
                'slug_name' => $hotel->slugName(),
                'rooms' => $hotel->rooms(),
                'score' => $hotel->score()
            ];
        }, $hotels);
    }
}
