<?php

declare(strict_types=1);

namespace App;
//DateTime class doesnt exists in custom namespace - add '\' to search in global namespace
// new \DateTime();

//Alias of DateTime
use DateTime as DT;

new DT();

class Account {
    //checks the current namespace for the class
    public SocialMedia $socialMedia;

    //static properties are similar to constants
    public static int $count = 0;

    //classes can have constants but only using const keyword
    public const INTEREST_RATE = 2.2;

    /*public string $name;
    public float $balance;

    public function __construct(string $newName, float $newBalance)
    {
        //php calls this method whenever the class is instantiated 
        $this->name = $newName;
        $this->balance = $newBalance;
    }*/

    //constructor property promotion - available in php 8 and above
    public function __construct(private string $name, private float $balance)
    {
       //access modifier needs to be added so that parameter are treated as properties 
       $this->socialMedia = new SocialMedia();
       //self - points to the class - used to access static properties 
       self::$count++;
    }

    //custom method - we can access instance properties within methods
    public function deposit(float $amount){
        $this->balance += $amount ;
        //to chain methods
        return $this;
    }

    public function getBalance(){
        //we can format the return value
        //we can perform query to retrieve db value or check if user has permissions to view the balance
        return '$' . $this->balance;
    }

    public function setBalance(float $newBalance): void{
        //setters can prevent setting a negative balance
        if($newBalance < 0){
            return;
        }
        $this->balance += $newBalance;
        $this->sendEmail();
    }

    //only this class can call this method after successful updation of balance
    private function sendEmail(){
        echo "Email sent successfully <br>";
    }
}