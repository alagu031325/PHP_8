<?php

include __DIR__ . '/src/Framework/Database.php';

use Framework\Database;

$db = new Database('mysql', [
    'host' => 'localhost',
    'port' => 3307,
    'dbname' => 'phpiggy'
], 'root', 'root');



// $search = "Hats' OR 1=1 --";
$search = "Hats";

// $query = "SELECT * FROM products WHERE name=?";
//we accidently assign a wrong value to the placeholder "?" so we can use named parameters
$query = "SELECT * FROM products WHERE name=:name";

//query method executes the query immediately but prepare method accepts a query and doesnt immediately execute it 

//FETCH_BOTH is the default and it returns an array with both numeric and num keys - popular ones are FETCH_NUM, FETCH_ASSOC - can be passed as argument only to the query method

$stmt = $db->connection->prepare($query);

//If we just need to assign the values to the query without executing it we can use bindValue method
// $stmt->bindValue('name', $search, PDO::PARAM_STR);
//If we bind the value we dont need to pass the array param into execute method
// $stmt->execute();

//order does matter first placeholder replaced by first item in the array and second ? replaced by 2nd item in the array 
//validates the value before it gets inserted into the query 
$stmt->execute([
    "name" => $search
]);

//override fetch mode
var_dump($stmt->fetchAll(PDO::FETCH_OBJ));
