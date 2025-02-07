<?php

include __DIR__ . '/src/Framework/Database.php';

use Framework\Database;

$db = new Database('mysql', [
    'host' => 'localhost',
    'port' => 3307,
    'dbname' => 'phpiggy'
], 'root', 'root');

try
{
    $db->connection->beginTransaction();

    $db->connection->query("INSERT INTO products VALUES(10, 'Gloves')");

    $query = "SELECT * FROM products WHERE name=:name";

    $stmt = $db->connection->prepare($query);

    $stmt->bindValue('name', 'Gloves', PDO::PARAM_STR);

    $stmt->execute();

    var_dump($stmt->fetchAll(PDO::FETCH_OBJ));

    //To end the transaction - saves the changes to the DB and ends the transaction -multiple transactions cant be active at the same time
    $db->connection->commit();
}
catch (Exception $error)
{
    //revert the changes applied by the queries performed from within transactions
    //if the transaction is active this method returns true
    if ($db->connection->inTransaction())
        $db->connection->rollBack();
    echo "Transaction Failed!!";
}
