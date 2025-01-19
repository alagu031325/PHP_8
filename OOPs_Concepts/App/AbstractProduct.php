<?php

namespace App;

//abstract classes cant be instantiated
abstract class AbstractProduct {
    //abstract class cant have private methods, only public or protected is allowed so that other classes can override them
    public function turnOn() {
        echo "Turning on Product .. ";
    }

    //each product can have different setup procedures - so child classes need to implement this 
    abstract public function setup();      
    
}