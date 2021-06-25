<?php

namespace THN\Shared\Infrastructure\Persistence\SQL;

use Exception;
use PDO;
use PDOException;

class THNPDO
{
    private const DNS = 'mysql:host=skeleton_mysql_1;dbname=thn';
    private const DB_USER = 'root';
    private const DB_PASS = 'root';

    protected $dsn;
    protected $username;
    protected $password;
    protected $pdo;

    public function __construct()
    {
        $this->dsn = self::DNS;
        $this->username = self::DB_USER;
        $this->password = self::DB_PASS;
        $this->pdo = $this->connection();
    }

    protected function connection(): PDO
    {
        return $this->pdo instanceof PDO ? $this->pdo : $this->connect();
    }

    public function connect(): PDO
    {
        $options = [];

        $this->pdo = new PDO($this->dsn, $this->username, $this->password, $options);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $this->pdo;
    }

    public function query($sqlToPrepare, $parameters = [], $singleResult = false, $column = false)
    {
        try {
            $this->connect();
            $query = $this->pdo->prepare($sqlToPrepare);
            $this->bindParams($query, $parameters);

            if ($singleResult === true) {
                $data = $query->fetch(PDO::FETCH_ASSOC);
            } elseif ($column === true) {
                $data = $query->fetchAll(PDO::FETCH_COLUMN);
            } else {
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
            }

            $this->close();
            return $data;
        } catch (PDOException $e) {
            $this->close();
            throw new PDOException();
        } catch (Exception $e) {
            $this->close();
        }
    }

    private function getParamType($value)
    {
        $type = 0;

        if (is_numeric($value) && ctype_digit($value)) {
            $type = PDO::PARAM_INT;
        }
        if (!ctype_digit($value)) {
            $type = PDO::PARAM_STR;
        }

        return $type;
    }

    private function bindParams($query, $parameters)
    {
        if (!empty($parameters)) {
            foreach ($parameters as $key => $value) {
                $paramType = $this->getParamType($value);
                $query->bindParam($key, $value, $paramType);
                $parameters[$key] = $value;
            }
        }

        return $query->execute($parameters);
    }

    public function close(): void
    {
        $this->pdo = null;
    }
}
