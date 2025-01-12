<?php

declare(strict_types = 1);

//magic constants - values change based on where we use them 
echo __DIR__ . '<br>';
echo __FILE__ . '<br>';

//Defining constants
//const keyword is used to define constants from within classes 
//We cant use const keyword within if stmts but we can use define()
if(!defined('GREETINGS')){
    //To avoid redefining constants
    define('GREETINGS','Hey there...');
}
echo GREETINGS;



