<?php

include_once '../Other_Concepts/navbar.php';

$paymentStatus = 2;

//match expressions - returns value - comparisons are strict - no type juggling like in switch 
$message = match($paymentStatus){
    //if the value matches the value passed - right side is returned
    1 => 'Success',
    2 => 'Pending',
    default => 'Denied'
};

var_dump($message);
