<?php

//prevents from passing value with wrong data type
declare(strict_types=1);

$count = 1;

//one alternative is "do...while;" where code atleast exexcutes once before condition is checked 
while($count < 15){
    echo "$count <br>";
    $count++;
}
