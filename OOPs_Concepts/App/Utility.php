<?php

namespace App;

class Utility {
    //utility functions are generic and can be used in different places
    
    //these static methods are not tied to any instance 
    /**
     * Doc Block: 
     * Neatly prints an array
     * 
     * Outputs an array surrounded by pre tags for formatting 
     * 
     * @param array $array The array to output
     * @return void
     * 
     */
    public static function printArr(array $array) {
        if(count($array)){
            throw new \InvalidArgumentException("Array is empty");
        }
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
}