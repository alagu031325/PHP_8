<?php

namespace App;

class CurrentWeek implements \Iterator {
    public \DateTime $date;
    public int $daysFrom = 0;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    public function current(): mixed{
        //this function will get executed for each iteration
        return $this->date->format('F j Y');
    }

    public function key(): mixed {
        return $this->daysFrom;
    }

    public function next(): void{
        $this->date->modify('tomorrow');
        $this->daysFrom++;
    }

    public function rewind(): void{
        //is called when the loop is initiated - so we can use this method to reset the values from within our class
        $this->date->modify('today');
        $this->daysFrom = 0;
    }

    public function valid(): bool {
        //It calls after next and rewind fns - after each iteration is completed
        return $this->daysFrom < 7;
        //To display dates from current week 
    }
}