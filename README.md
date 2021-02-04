# Porter

Porter helps you with deploying application from dev directory.

[![version](https://img.shields.io/badge/version-0.1.5-informational "version")](https://img.shields.io/badge/version-0.1.6-informational "version") [![PHP version](https://img.shields.io/badge/PHP-7.3%2B-blue "PHP version")](http:/https://img.shields.io/badge/PHP-7.3%2B-blue/ "PHP version")

## How to use

Basic CLI implementation might look like this:

```php
#!/usr/bin/env php
<?php
/**
 * Porter CLI implementation
 */
use Infernusophiuchus\Porter\Main as Porter;
use Infernusophiuchus\Porter\Exceptions\MainException;

require_once __DIR__.'/src/porter-autoload.php'; // need to replaced by your path

try {

    new Porter(
        __DIR__, // <-- basic directory
        '/dev/dist', // <-- distributive directory
        '/', // <-- deployment directory
        (string)$argv[1] // <-- command
    );

} catch (MainException $e) {

    echo "\nERROR, ".$e->getCode().": ".$e->getMessage()."\n";

}

```

Check the **help** command to learn other available commands. It is very simple!
