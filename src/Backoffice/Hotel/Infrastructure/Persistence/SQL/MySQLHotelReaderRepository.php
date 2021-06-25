<?php

namespace THN\Backoffice\Infrastructure\Persistence\SQL;

use THN\Backoffice\Hotel\Domain\HotelReaderRepositoryInterface;
use THN\Backoffice\Hotel\Insfrastructure\Factory\MysqlHotelFactory;
use THN\Shared\Infrastructure\Persistence\SQL\THNPDO;

class MySQLHotelReaderRepository implements HotelReaderRepositoryInterface
{
    private $pdo;

    public function __construct(
        THNPDO $pdo
    ) {
        $this->pdo = $pdo;
        $this->hotelFactory = new MysqlHotelFactory();
    }

    public function list(): array
    {
        $sql = "SELECT id, name, slug_name, rooms, score, created_at, updated_at
                FROM `hotel`";

        $result = $this->pdo->query($sql);

        return $this->hotelFactory->createFromResultSet($result);
    }
}
