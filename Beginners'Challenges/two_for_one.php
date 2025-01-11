<?php

declare(strict_types=1);

function twoForOne(string $name='you'): string{  
        return "One for $name, one for me.";
}

echo twoForOne();