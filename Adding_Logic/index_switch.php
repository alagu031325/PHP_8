<?php

$paymentStatus = '1';

//switch checks for equality - value can be int/float/string
switch($paymentStatus){
    //values dont have to be the same type - php does type juggling
    case 1:
        echo 'Payment Successful';
        break;
    //Multiple cases can print the same outcome
    case 2:
    case 3:
        echo 'Payment Pending';
        break;
    default:
        echo 'Payment Failure';
}
