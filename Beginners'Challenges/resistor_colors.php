<?php

function colorCode(string $color): int
{
    $resistorColors = [
        'black' => 0,
        'brown' => 1,
        'red' => 2,
        'orange' => 3,
        'yellow' => 4,
        'green' => 5,
        'blue' => 6,
        'violet' => 7,
        'grey' => 8,
        'white' => 9
    ];

    foreach($resistorColors as $key => $value){
        if($key === $color){
            return $value;
        }
    }
}

$colorCodeValue = colorCode('orange');
echo $colorCodeValue;