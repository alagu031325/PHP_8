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
use App\{Account, SocialMedia, Utility, ToasterPremium, A2BRestaurant, C2DRestaurant, EmptyArrayException, FoodApp, RestaurantInterface, CurrentWeek};

$currentWeek = new CurrentWeek();

//iterable type accepts arrays/objects that implement Iterator i/f
function displayWeek(iterable $iterable){
    //we can iterate over objects like we do in arrays 
    foreach($iterable as $key => $value){
        var_dump($key, $value);
        echo "<br>";
    }
}

displayWeek($currentWeek);

//calls __construct method - we can assign values to properties 
$nannyPlumAccount = new Account('Nanny Plum',20.45);
//DateTime predefined class is in global namespace
$timezone = new DateTimeZone("America/Chicago");
$date = new DateTime("06/07/1956",$timezone);
//accepts hours and mintues
$date->setTime(9, 40);
echo "<pre>";
var_dump($date->format('F j Y'));
echo "</pre>";

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

try{
    Utility::printArr([]);
} catch (InvalidArgumentException|EmptyArrayException $exception){
    echo "<br> Custom Exception : {$exception->getMessage()} <br>";
} catch (\Exception $exception){
    echo "Generic Exception : {$exception->getMessage()} <br>";
} finally {
    //php executes the code within finally block even if an error gets thrown
    echo "Finally block <br>";
}

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






