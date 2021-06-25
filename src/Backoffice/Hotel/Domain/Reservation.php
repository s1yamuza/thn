<?php

namespace THN\Backoffice\Hotel\Domain;

use THN\Shared\Domain\Hotel\Room;

class Reservation
{
    private $id;
    private $room;
    private $hotelName;
    private $userName;

    public function __construct(
        int $id,
        int $room,
        string $hotelName,
        string $userName
    ) {
        $this->id = $id;
        $this->room = new Room($room);
        $this->hotelName = $hotelName;
        $this->userName = $userName;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function room(): Room
    {
        return $this->room;
    }

    public function hotelName(): string
    {
        return $this->hotelName;
    }

    public function userName(): string
    {
        return $this->userName;
    }
}
