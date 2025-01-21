## OOPs Concepts

### Magic Methods

- Magic methods are called by php from with our class during specific instance
- Instances contain unique copies of properties from the class - since multiple objects can have same property - we refer to the correct instance via '$this' keyword - so other instances of the same class remain unaffected

### Namespaces

- Most significant advantage is that we can reuse file names under different namespaces
- Helps Organise code
- avoids name conflicts

### Autoloading

- spl_autoload_register - we need to pass a callback to be executed - when a class is used - php searches for call definition if it cant find the class - it will execute the function passed into spl_autoload_register function

### static properties

- are like global variables and can be changed from any where within the program by accessing it using scope resolution operator - dont use them unless it is necessary
- static methods can be more useful than static properties
- the methods defined within the class benefits from autoloading than the regular functions

### OOP Principle

- **Encapsulation** - process of restricting data and methods to a single class - public properties are vulnerable as global variables - mainly achieved through access modifiers
- **Abstraction** - idea of hiding complex details from the user - Objects can provide a level of abstraction by defining methods that handle complex actions
- **Inheritance** - one class can be derived from another class - implemented using 'extends' keyword - inherited classes should maintain a 'is-a' relationship with the parent class
- _Concrete class_ is a class where all its method has an implementation
- _Abstract classes_ - does not have implemented methods or contains partially implemented methods
- _Interfaces_ - all methods are fully abstract
- **Polymorphism** - Object can be represented in multiple forms - so if we have object of type restaurant interface it can either accept A2B Restaurant or C2D Restaurant - so we use interfaces and abstract classes to implement polymorphism
- _Anonymous Classes_ - classes without name - no new file created for one time use classes - for prototyping classes before implementing the real class - useful for testing purposes to temporarily test classes - they are faster than regular classes since they dont require autoloading
