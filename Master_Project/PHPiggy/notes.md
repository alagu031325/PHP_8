### Modifying Php settings

- Info about the current php installation - phpinfo()
- $\_SERVER - super global variable - stores info about current server and request
- ini_set('memory_limit', '255M') - it affect only the current php script - if set in php.ini config file - it will affect all the php scripts
- echo ini_get('memory_limit') - To output the value of config directive

### Composer

- To create composer.json - composer init command
- after adding a new namespace to autoload classes - we need to run composer dump-autoload to regenerate the files
- for functions to be autoloaded add the file name containing functions under "files" directive in composer.json and run "composer dump-autoload" command in the command line

### Reflective Programming

- Ability for a program to look at itself and inspect its properties - Our container doesnt know what dependancies are needed by the controller - so it has to look into class to understand what dependancies it needs
