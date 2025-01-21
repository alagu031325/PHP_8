<?php

declare(strict_types = 1);

class DNA {
    //also can be accomplished with substr_count($input, 'A') method
    public static function nucleotide(string $input): array{
        $charArray = str_split($input);
        sort($charArray);
        $countsArray = [];
        foreach($charArray as $char){
            if(!array_key_exists($char, $countsArray) ){
                $countsArray[$char] = 1;
            }
            else{
                $countsArray[$char]++;
            }
        }
        return $countsArray;
    }
}

print_r(DNA::nucleotide("GATTACA"));