<?php

declare(strict_types=1);

$alphabetsArray = range('A','Z');

function getRobotName() : string {
    global $alphabetsArray;
    //can also use array_rand function to get random indexes and concat the letters at those indexes
    shuffle($alphabetsArray);
    $randomInt = mt_rand(100, 999);
    $robotName = "{$alphabetsArray[0]}{$alphabetsArray[1]}{$randomInt}";
    return $robotName;
}
echo getRobotName() . "<br>";
echo getRobotName() . "<br>";