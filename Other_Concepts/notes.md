# Filling in the Gaps

## Predefined constants

- PHP_INT_MAX/PHP_INT_MIN - max and min int values
- Magic constants - unlike constants the value of these can change - it helps to access features of the current file

## Predefined Functions

- ceil/floor - to round numbers either up or down
- round - we can use mode parameter to either round up or down when the number is half way through
- count function returns the number of items in the array

## include/require

- we can include same files multiple times - everytime we include a file php tries to execute the file so it can lead to errors - specially when const are defined when the file is included twice - it tries to define the const - so we use include_once instead of include so the code is executed only once
- we can also use require/require_once keywords - both are used to add files into another file but the main difference is how they handle errors - require throws errors which results in stopping the execution of rest of the script whereas include throws warning to not to stop the execution of the script

- if the file is needed then we can use require keyword to stop the execution if the file is missing else we can use include keyword

## Scope

- refers to the accessibility of variables based on its location - variables defined outside cannot be accessible inside the function unless specified with global keyword and vice versa

## Pass by value

- Everytime we pass a variable to the function it creates a copy of the variable's value and assigns it in the parameter so when the parameter changes the original value is not reflected

## Pass by reference

- Instead of creating a copy of the variable we have direct access to the passed variable
