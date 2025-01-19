<?php

declare(strict_types = 1);

function slices(string $series, int $size): array{
    $length = strlen($series);
    if($length < $size || $size < 1)
        return [];
    $results = [];
    for($i=0; $i <= $length - $size; $i++){
        $results[] = substr($series, $i, $size);
    }

    return $results;
}
print_r(slices('197654',4));