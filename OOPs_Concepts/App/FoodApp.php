<?php

namespace APP;

use App\A2BRestaurant;
use App\RestaurantInterface;

class FoodApp{
    //restaurant can have multiple forms like A2B and C2D - so will just check if the object implements the interface 
    public function __construct(RestaurantInterface $restaurant){
        $restaurant->prepareFood();
    }
}