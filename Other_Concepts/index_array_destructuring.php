<h2>Array Destructuring: </h2>

<?php

$favNums = [3, 7, 13, 25];

//list is used to destructure items from an array 
list($num1, $num2) = $favNums;

echo $num1 . '<br>' . $num2 . "<br>"; //first and second number retrieved 

//alternative syntax
[ , , $num3, $num4] = $favNums;

echo $num3. '<br>' . $num4 . '<br>';

//if array use specific keys - our variables in destructuring should also use specific keys
$nums = ['dad' => 26, 'mom' => '6'];

//if we dont give specific key then it will search for value in 0th index
['dad' => $num1] = $nums;

echo $num1 . "<br>"; 

//Destructuring allows us to assign specific name to the value in an array 
