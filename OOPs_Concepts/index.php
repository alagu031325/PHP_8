<?php

declare(strict_types=1); ?>

<h2>OOP</h2>

<?php 

// require_once 'App/Account.php';

spl_autoload_register(function($class){
    //'\' escape character - tells php not to end the string with " so to override this behavior we use 
    //backslash replaced by forward slash 
    $formattedClass = str_replace("\\", "/", $class);
    $path = "{$formattedClass}.php";
    // echo $path;

    //useful when we have more files with classes to be loaded 
    require_once $path;
});

//used to resolve classes from custom/global namespaces
use App\{Account, SocialMedia, Utility, ToasterPremium, A2BRestaurant, C2DRestaurant, FoodApp, RestaurantInterface};

//calls __construct method - we can assign values to properties 
$nannyPlumAccount = new Account('Nanny Plum',20.45);
//DateTime predefined class is in global namespace
new DateTime();

//method chaining - is useful to call multiple methods from same class but not always necessary when we need to return other values 

//Null-safe operator - this is applicable only with objects
$nannyPlumAccount?->deposit(120)->deposit(30);

var_dump($nannyPlumAccount);


//scope resolution operator - read constants from class without the need for instance
// var_dump($nannyPlumAccount::INTEREST_RATE);
var_dump(Account::INTEREST_RATE);

echo '<br>';

//we can also access static propery with an instance
var_dump($nannyPlumAccount::$count);

Utility::printArr([34,45,56,67]);
Utility::printArr([]);

$nannyPlumAccount->setBalance(45);
var_dump($nannyPlumAccount->getBalance());
echo "<br>";

//Inheritance
$myToaster = new ToasterPremium(5);
$myToaster->toast();

//Interface
$restaurant1 = new FoodApp(new A2BRestaurant());
$restaurant2 = new FoodApp(new C2DRestaurant());

//Anonymous class
$restaurant = new FoodApp(new class ("Mobile Restaurant") implements RestaurantInterface{
    public function __construct(public string $name)
    {
        
    }
    public function prepareFood()
    {
        echo "<br> {$this->name} preparing food ... ";
    }
});






