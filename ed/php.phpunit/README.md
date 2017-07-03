phpUnit
-
*PHPUnit 3.7*

/usr/share/php/PHPUnit
/usr/share/php/PHPUnit/Extensions/SeleniumTestCase.php

`
phpunit -d memory_limit=16M -c include/tests/conf.xml /tests/unit/
`

#### DB
````
vendor/bin/phpunit ed/phpUnit/examples/db/
vendor/bin/phpunit -c ed/phpUnit/examples/db/phpunit.xml ed/phpUnit/examples/db/

mysqldump --xml -t -u root --password= testdrive > /tmp/testdrive.xml

````

https://phpunit.de/manual/current/en/database.html#database.the-connection-api