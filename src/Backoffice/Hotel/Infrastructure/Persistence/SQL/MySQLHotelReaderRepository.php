<?php

namespace THN\Backoffice\Hotel\Infrastructure\Persistence\SQL;

use THN\Backoffice\Hotel\Domain\HotelReaderRepositoryInterface;
use THN\Backoffice\Hotel\Insfrastructure\Factory\MysqlHotelFactory;
use THN\Backoffice\Hotel\Insfrastructure\Factory\MysqlReservationFactory;
use THN\Shared\Infrastructure\Persistence\SQL\THNPDO;

class MySQLHotelReaderRepository implements HotelReaderRepositoryInterface
{
    private $pdo;

    public function __construct(
        THNPDO $pdo
    ) {
        $this->pdo = $pdo;
        $this->hotelFactory = new MysqlHotelFactory();
        $this->reservationFactory = new MysqlReservationFactory();
    }

    public function list(): array
    {
        $sql = "SELECT id, name, slug_name, rooms, score, created_at, updated_at
                FROM hotel";

        $result = $this->pdo->query($sql);

        return $this->hotelFactory->createFromResultSet($result);
    }

    public function reservation(int $hotelId): array
    {
        $sql = "SELECT r.id, r.room_number, h.name as hotel_name, u.name as user_name
                FROM reservation r
                LEFT JOIN hotel h ON h.id = r.hotel_id
                LEFT JOIN user u ON u.id = r.user_id
                WHERE h.id = :hotel_id";

        $parameters = [
            ':hotel_id' => $hotelId
        ];

        $result = $this->pdo->query($sql, $parameters);

        return $this->reservationFactory->createFromResultSet($result);
    }
}
