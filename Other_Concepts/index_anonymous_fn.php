Anonymous Functions : <br>

<?php

//Function that doesnt have a name - treated as expressions so can be stored in a variable

$multiplier = 2;

//use keyword helps to access the variables defined outside of the functions - php creates copy of the variable instead of directly using that variable
$multiply = function($num) use($multiplier){
    $multiplier = 5;
    return $num * $multiplier;
};

//remains unchanged
echo  $multiplier ."<br>" ;

//callback is a fn passed to another fn to be called later
function sum($a, $b, $callback){
    return $callback($a + $b);
}

//should use '$' when reference the function by a variable 
echo sum(5, 2, $multiply) . "<br>" ;

//Advantages of using Anonymous Functions:
/*1. we can easily swap the function with another function - alter the behavior of a function in moment's notice
$multiply = function($num) {
    return $num * 3;
};*/
//2. we can pass the function to a another function as an argument - we can swap callback functions with different functions
//3. They can access global variables without directly modifying the original value - with the help of use keyword
//4. Arrows functions are shorter way of writing anonymous functions - arrow function should always return a value - and is restricted to single line of code - we cant add {} and have additional line of code
// $multiply = fn ($num) => $num * $multiplier; [no need to include use and return key words - arrow functions have access to variables from parent scope]

