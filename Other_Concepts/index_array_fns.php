<h2>Array Functions : </h2>

<?php

$users = ['Ben','Holly','Nanny Plum','Little Kingdom', null, false, 'false', '', '0'];

//To check if an item exists - 
if(isset($users[4])){
    echo "User Found!! - isset <br>";
}
else{
    // considers null and false values - to be same as not having a value in that index 
    echo "No User Found:( - isset <br> ";
}

//so we can use alternate fn
if (array_key_exists(4, $users)){
    //allows for null and false values - as long as their is a value in specific index
    echo "User Found ... - array_key_exists <br>";
}   

//removes items with empty values 'null' or 'false' - no callback passed - else filters based on the callback 
$users_filtered = array_filter($users, fn($user) => $user !== 'false');
//prints each array element in the new line 
echo '<pre>';
echo "array_filter <br>";
print_r($users_filtered);
echo '</pre>';

//array_map - used to modify each value and return the new array 
$users_modified = array_map(fn($user) => strtoupper($user) ,$users);
echo '<pre>';
echo "array_map <br>";
print_r($users_modified);
echo '</pre>';

//merge more than 1 array 
$users_merged = array_merge($users, ['Queen Thistle','King Thistle']);
echo '<pre>';
echo "array_merge <br>";
print_r($users_merged);
echo '</pre>';

/*Sorting arrays - returns bool value - sorts alphabetically and indexes are re-indexed - but if we use assosiative array named indexes are ignored
$users_sorted = sort($users);
if($users_sorted){
    echo '<pre>';
    echo "array sort <br>";
    print_r($users);
    echo '</pre>';
}*/

//asort function - sorted alphabetically but maintains the key assosiation
$users_sorted = asort($users);
if($users_sorted){
    echo '<pre>';
    echo "array sort <br>";
    print_r($users);
    echo '</pre>';
}