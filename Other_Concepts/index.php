<h2>Filesystem Functions: </h2>

<?php

//returns array containing a list of files in the directory specified
$directory = scandir(__DIR__);
echo '<pre>';
print_r($directory);
echo '</pre>';

//to new dire
// mkdir('arrays');
//directory must be empty before it is deleted
// rmdir('arrays');

if(file_exists('navbar.php')){
    echo "File Found!!" . "<br>";
    //returns the size of the file
    echo filesize('navbar.php');

    //to add contents to a file - it creates the file if doesnt exists
    //file_put_contents('intro.php','Hello World!!');
    //file_get_contents('intro.php');

    //checking file data can be expensive action so for performance reasons php cache filesystem functions results 
    clearstatcache(); //clears file's meta data cache 
}




