<?php

declare(strict_types = 1);

//If user has permission 1 - admin , 2 - moderator - any other number is guest
$permission = 2;

//Alternate syntax - generally used in template files for readability
if($permission === 1): ?>
    <h1>Hello admin!!</h1>
<?php elseif($permission === 2): ?>
    <h1>Hello moderator..</h1>
<?php else: ?>
    <h1>Hello guest</h1>
<?php endif; ?>




