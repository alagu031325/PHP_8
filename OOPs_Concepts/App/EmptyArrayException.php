<?php

namespace App;

//Custom Exception
class EmptyArrayException extends \Exception {
    //overriding message property from exception
    protected $message = "Array is empty";
}