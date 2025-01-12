<h2>Callable DataType : </h2>

<?php 
$multiplier = 2;

$multiply = fn($num) => $num * $multiplier;

//callable datatype can be used for callback functions - to tell php that the parameter holds a function
function sum(int|float $num1, int|float $num2, callable $callback){
    return $callback($num1 + $num2);
}

echo "Sum function / Multiply : " . sum(3, 9 , $multiply);
echo "<br> Sum function / Divide: " . sum(2, 8 , 'divide');

//NOTE: If we plan to use regular functions instead of anonymous functions we need to pass in the name of the function as a string for callable parameter

function divide($num){
    return $num/2;
}