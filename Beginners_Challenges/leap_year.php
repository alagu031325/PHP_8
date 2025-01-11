<?php

declare(strict_types=1);

function isLeap(int $year): bool{
    if ($year%4 !== 0){
        return false;
    }
    if ($year%100 === 0 && $year%400 !== 0){
        return false;
    }
    return true;

    // another alternative solution
    // return (!($year % 4) && $year % 100) || !($year % 400);
}

$isLeapYear = isLeap(2000);
var_dump($isLeapYear);