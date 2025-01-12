Static Variables : <br>

<?php


function foo(){
    //retain value even after function execution
    static $num1 = 5;
    return $num1++;
    //deletes the variables after the function completes its execution - non static 
}

echo foo() . "<br>";
echo foo() . "<br>";
echo foo() . "<br>";



