<?php

include_once '../Other_Concepts/navbar.php';

$score = 70;

//if evaluates the expression to bool value
if($score >= 70 && $score <= 100) {
    echo "Distinction";
} else if($score >= 40 && $score < 70) {
    echo "Merit";
} else {
    echo "Resit";
}