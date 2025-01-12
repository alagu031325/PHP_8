<?php

declare(strict_types=1);

include_once '../Other_Concepts/navbar.php';

//if we want to execute a particular block of code 'n' times - whereas while loops are not restricted by numbers 

for($initialValue = 1; $initialValue <=10 ; $initialValue++){
    if($initialValue === 7){
        //stops the current iteration
        continue;
        //break keyword - ends the loop execution
    }
    echo "$initialValue <br>";
}