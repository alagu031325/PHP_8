<?php

declare(strict_types=1);

$names = ['Ben', 'Holly', 'Nanny Plum'];

//as keyword to create a reference for each item in the array 
foreach($names as $key => $name){
    var_dump($key , $name);
}