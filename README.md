# Porter

Porter helps you with deploying application from dev directory.

[![version](https://img.shields.io/badge/version-0.2.2-informational "version")](https://img.shields.io/badge/version-0.2.2-informational "version") [![PHP version](https://img.shields.io/badge/PHP-7.3%2B-blue "PHP version")](http:/https://img.shields.io/badge/PHP-7.3%2B-blue/ "PHP version")

## How to use

Basic CLI implementation might look like this:

```php
#!/usr/bin/env php
<?php
/**
 * Porter CLI implementation
 */
use Infernusophiuchus\Porter\Entrance as Porter;
use Infernusophiuchus\Porter\Exceptions\EntranceException;

// Special autoloader for avoid loading other packages if you do not need it.
require_once __DIR__.'/vendor/infernusophiuchus/porter/src/porter-autoload.php';

try {

    new Porter($argv);

} catch (EntranceException $e) {

    echo "\nERROR, ".$e->getCode().": ".$e->getMessage()."\n";

}

```

After implementation completed, you must setup your Porter with **set** command. Check the **help** command to learn how and discover other available commands. It is very simple!
