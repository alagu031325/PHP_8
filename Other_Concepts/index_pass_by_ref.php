<h2>Passing by Reference</h2>

<?php

$cup = "empty";

//pass by reference - no longer creates unique copy of variable 
function fillCup(&$cupCopy) {
    $cupCopy = 'filled';
}

fillCup($cup);

//retains the original value - in pass by value
echo $cup;

//It gives the flexibilty to call the function with any argument rather than using global keyword to explicitly define the variables within the function 