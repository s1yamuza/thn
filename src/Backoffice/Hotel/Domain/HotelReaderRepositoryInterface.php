<?php

namespace THN\Backoffice\Hotel\Domain;

interface HotelReaderRepositoryInterface
{
    public function list(): array;
}
