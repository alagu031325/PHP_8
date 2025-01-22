### Modifying Php settings

- Info about the current php installation - phpinfo()
- ini_set('memory_limit', '255M') - it affect only the current php script - if set in php.ini config file - it will affect all the php scripts
- echo ini_get('memory_limit') - To output the value of config directive

### Composer

- To create composer.json - composer init command
- after adding a new namespace to autoload classes - we need to run composer dump-autoload to regenerate the files
