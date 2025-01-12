<?php

declare(strict_types = 1);

$names = ['Nanny Plum','Ben','Holly'];
//we can delete a variable after it is being created using unset
print_r($names);
//deletes from memory - unsets 2nd item in the array - but doesnt reindex arrays
unset($names[1]);
//used to print arrays - data type not printed as in var_dump()
print_r($names);

//array_values function accepts array that needs to be reindexed
$names = array_values($names);
print_r($names);




