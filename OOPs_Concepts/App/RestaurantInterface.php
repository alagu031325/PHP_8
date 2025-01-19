<?php 

namespace App;

interface RestaurantInterface {
    //we can define constants but properties are not allowed in interfaces
    //all methods must be abstract they cant have implementation 

    //by default all methods are abstract so abstract keyword is not necessary
    public function prepareFood();

}