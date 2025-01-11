<?php

declare(strict_types=1);

function isLeap(int $year): bool{
    if($year%4 === 0){
        if($year%100 === 0){
            if($year%400 === 0){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return true;
        }
    }else{
        return false;
    }
}

$isLeapYear = isLeap(2000);
var_dump($isLeapYear);