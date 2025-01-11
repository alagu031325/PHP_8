<?php

declare(strict_types=1);

function twoForOne(string $name=''): string{
    if($name)
        return "One for $name, one for me";
    else    
        return "One for you, one for me";
}

echo twoForOne('Nanny Plum');