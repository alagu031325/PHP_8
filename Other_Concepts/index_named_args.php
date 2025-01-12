

<h2> Named Arguments :</h2>

<?php

function sum(int|float $num1, int|float $num2){
    var_dump($num2, $num1);
    return $num1 + $num2;
}

//Named arguments - Php 8 - useful when a function has more parameters and some of them are optional - we skip providing values for some parameters
echo "Sum function : " . sum(num2: 89, num1: 90);

?>