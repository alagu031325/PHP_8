<?php

declare(strict_types=1);

namespace Framework;

use PDO, PDOException, PDOStatement;

class Database
{
    private PDO $connection;
    private PDOStatement $stmt;

    public function __construct(string $driver, array $config, string $username, string $password)
    {

        //array converted to string as key value formatted similarly to a DNS string
        $config = http_build_query(data: $config, arg_separator: ';');

        $dsn = "{$driver}:{$config}";

        //creates connection to the database
        try
        {
            //Default fetch mode settings modifies fetch mode for all queries
            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }
        catch (PDOException $e)
        {
            die("Unable to connect to database");
        }
    }

    public function query(string $query, array $params = []): Database
    {
        $this->stmt = $this->connection->prepare($query);

        $this->stmt->execute($params);

        return $this;
    }

    public function count()
    {
        //fetches a single result from an array - in our case the count
        return $this->stmt->fetchColumn();
    }

    public function find()
    {
        //returns result from query as an array (fetch mode set in constructor)
        return $this->stmt->fetch();
    }

    public function findAll()
    {
        return $this->stmt->fetchAll();
    }

    public function id()
    {
        return $this->connection->lastInsertId();
    }
}
