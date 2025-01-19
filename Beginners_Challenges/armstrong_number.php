<?php 

declare(strict_types=1);

function isArmstrongNumber(int $number): bool{
    //because of strict type enabled implicit type juggling is not possible
    $digitsArray = str_split((string)$number);
    $count = count($digitsArray);
    $modifiedArray = array_map((fn($digit) => $digit ** $count),$digitsArray);
    //takes int or float array and returns int or float - array_sum
    return array_sum($modifiedArray) == $number;
}

echo isArmstrongNumber(153);//true
echo isArmstrongNumber(154);//false