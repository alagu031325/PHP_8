

<h2> Control Structures </h2>

<?php
//To load a different file
include_once 'navbar.php';

//spread operator - accepts n number of arguments - Variadic Function - the variadic parameter must be the last
function sum(bool $dumpArr, int|float ...$nums){
    if($dumpArr){
        var_dump($nums);
    }
    //will loop through the array of numbers and calculate the sum 
    return array_sum($nums);
}

echo "Sum function : " . sum(false, 9,67,89,90);

?>