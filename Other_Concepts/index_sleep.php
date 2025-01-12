<?php

declare(strict_types=1);

function getPermission(){
    //pause the execution for 2secs
    sleep(2);

    //If user has permission 1 - admin , 2 - moderator - any other number is guest
    return 2;
}

//Alternate syntax - generally used in template files for readability
if(getPermission() === 1): ?>
    <h1>Hello admin!!</h1>
    <!-- Php waits for 4 secs before the result is displayed - because the function is executed twice so the value can be stored in variable for optimization or we can use switch stmts-->
<?php elseif(getPermission() === 2): ?>
    <h1>Hello moderator..</h1>
<?php else: ?>
    <h1>Hello guest</h1>
<?php endif; ?>