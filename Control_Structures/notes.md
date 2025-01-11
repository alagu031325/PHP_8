# Adding_Logic

## Expression

- Single line of code that evaluates to a value

## Functions

- functions defined inside conditional statements are not readily available they need to be defined first before the function can be called/invoked
- if functions are defined globally the order of function invokation and function definition doesnt matter
- function arguments are values to the function's parameter list

### Type Hinting

- To tell php the return type of the function (: ?string - after the paranthesis signifies that the function can either return null or string) and parameters can also be type hinted
- 'int|float $paymentStatus' - union types
- for parameter that accepts all data type we can use 'mixed' data type as a shortcut
