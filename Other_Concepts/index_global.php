Global Variables : <br>

<?php

//accessible to every file and functions 
$x = 5;

function foo(){
    //instructs php to look for variables defined in global scope
    global $x;
   
    //can access variabled defined within the function
    echo $x;
    $x++;
}

//variable changed from within function - less reliable since values can change any time - so recommended to use parameters and return values to update variables
echo $x++;
foo();



