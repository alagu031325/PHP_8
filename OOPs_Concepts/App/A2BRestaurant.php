<?php

namespace App;

//multiple interfaces can be implemented but only one class can be extended
class A2BRestaurant implements RestaurantInterface{
    public function prepareFood()
    {
        echo "<br> Preparing food from A2B Restaurant!!!";
    }
}