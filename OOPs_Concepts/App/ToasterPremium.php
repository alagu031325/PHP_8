<?php

declare(strict_types=1);

namespace App;

//inherits properties and method from another class
class ToasterPremium extends Toaster{
    //prioritise the property defined in current class
    protected int $slots;

    private int $duration;

    //__construct method parameter no need to match with parent class
    public function __construct(int $newDuration) {
        //this again sets the $this->slots, hence overrides the value 4 if defined after
        parent::__construct();
        $this->slots = 4;
        $this->duration = $newDuration;
    }

    //we can override the method but their name and parameter list must match 
    public function toast(){
        //parent helps to access the methods from the class that we are extending 
        parent::toast();
        echo " for {$this->duration} minutes.";
    }

}