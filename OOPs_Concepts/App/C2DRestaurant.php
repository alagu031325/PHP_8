<?php

namespace App;


class C2DRestaurant implements RestaurantInterface{
    public function prepareFood(){
        echo "<br> Preparing food from C2D Restaurant ...";
    }
}