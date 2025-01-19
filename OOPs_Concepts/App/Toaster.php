<?php

declare(strict_types=1);

namespace App;

//final keyword - prevents other classes from extending the current class 
class Toaster extends AbstractProduct{
    //if we use private then child class also cant modify this property
    protected int $slots;

    public function __construct(){
        $this->slots = 2; 
        $this->turnOn();
    }

    //we can also just define methods as final to prevent overriding them 
    public function toast(){
        echo "{$this->slots} Toasting Bread";
    }

    public function setup(){
        echo "Setup for toaster is done";
    }
}