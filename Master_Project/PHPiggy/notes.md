### Modifying Php settings

- Info about the current php installation - phpinfo()
- $\_SERVER - super global variable - stores info about current server and request
- ini_set('memory_limit', '255M') - it affect only the current php script - if set in php.ini config file - it will affect all the php scripts
- echo ini_get('memory_limit') - To output the value of config directive
- Apache config/extras - httpd-vhost config edited to map phppiggy to its corresponding project URL - and to write rewrite rules

### Composer

- To create composer.json - composer init command
- after adding a new namespace to autoload classes - we need to run composer dump-autoload to regenerate the files
- for functions to be autoloaded add the file name containing functions under "files" directive in composer.json and run "composer dump-autoload" command in the command line

### Reflective Programming

- Ability for a program to look at itself and inspect its properties - Our container doesnt know what dependancies are needed by the controller - so it has to look into class to understand what dependancies it needs

### HTTP Status Code

- 1xx - Information
- 2xx - Success
- 3xx - Redirection
- 4xx - Client Error(Errors that occur on the browser)
- 5xx - Server Error(Errors that occur on the server side)

### Sessions

- Sessions are a feature for storing data longer than a single request - They are destroyed after a user closes a browser
- Cookies are sent as headers from the server - it sets the session id in the cookies - so php needs access to the headers - but headers are not guaranteed to be always available - so if headers cant be added then sessions cant be started

### Php scripts

- To run php scripts we add scripts to the composer and add our custom command
- `composer run-script phpiggy` - will help us to execute the script in the command line

### Prepared statements

- Are a feature of DB and they are reusable we can swap data at moment's notice
- DBs can validate the values before executing the queries - avoiding direct sql injections which might happen when we embed form's data into sql where conditions
