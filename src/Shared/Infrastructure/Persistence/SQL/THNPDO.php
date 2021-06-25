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

    /**
     * @return PDO
     */
    protected function connection(): PDO
    {
        return $this->pdo instanceof PDO ? $this->pdo : $this->connect();
    }

    /**
     * @return PDO
     */
    public function connect(): PDO
    {
        $options = [];

        $this->pdo = new PDO($this->dsn, $this->username, $this->password, $options);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $this->pdo;
    }

    /**
     * @param $sqlToPrepare
     * @param array $parameters
     * @param bool $singleResult
     * @param bool  $column
     * @return mixed
     * @throws PDOException
     */
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

    /**
     * @param  $sqlToPrepare
     * @param  array $parameters
     * @return mixed
     * @throws PDOException
     */
    public function insert($sqlToPrepare, $parameters = [])
    {
        try {
            $this->connect();
            $query = $this->pdo->prepare($sqlToPrepare);
            $this->bindParams($query, $parameters);

            $lastInsertId = $this->pdo->lastInsertId();
            $this->close();
            return $lastInsertId;
        } catch (PDOException $e) {
            $this->close();
            throw new PDOException();
        } catch (Exception $e) {
            $this->close();
        }
    }

    /**
     * @param  $sqlToPrepare
     * @param  array $parameters
     * @return bool
     * @throws PDOException
     */
    public function delete($sqlToPrepare, $parameters = [])
    {
        try {
            $this->connect();
            $query = $this->pdo->prepare($sqlToPrepare);
            $this->bindParams($query, $parameters);

            if ($query->rowCount() > 0) {
                return true;
            }
            $this->close();
            return false;
        } catch (PDOException $e) {
            $this->close();
            throw new PDOException();
        } catch (Exception $e) {
            $this->close();
        }
    }

    /**
     * @param $sqlToPrepare
     * @param array $parameters
     * @return bool
     * @throws PDOException
     */
    public function update($sqlToPrepare, $parameters = [])
    {
        try {
            $this->connect();
            $query = $this->pdo->prepare($sqlToPrepare);
            $this->bindParams($query, $parameters);

            if ($query->rowCount() > 0) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            $this->close();
            throw new PDOException();
        } catch (Exception $e) {
            $this->close();
        }
    }

    /**
     * @param $value
     * @return int
     */
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

    /**
     * @param $query
     * @param $parameters
     * @return mixed
     */
    private function bindParams($query, $parameters)
    {
        if (!empty($parameters)) {
            foreach ($parameters as $key => $value) {
                $castValue = $this->simpleCast($value);
                $paramType = $this->getParamType($value);
                $query->bindParam($key, $castValue, $paramType);
                $parameters[$key] = $castValue;
            }
        }
        return $query->execute($parameters);
    }

    public function close(): void
    {
        $this->pdo = null;
    }

    /**
     * When this function is called and passed as an argument for a function
     * that expects an argument by reference can cause errors on php ^7.2
     * Just return its value by reference to solve it.
     *
     * @param  $value
     * @return float|int|null|string
     */
    public function &simpleCast($value)
    {
        if ($value === null || $value === true || $value === false) {
            return $value;
        }

        if (is_numeric($value) && intval($value) != $value) {
            return floatval($value);
        }

        if (is_string($value) && !ctype_digit($value)) {
            return $value;
        }

        if (ctype_digit($value) || $value == intval($value)) {
            return intval($value);
        }

        return $value;
    }
}
