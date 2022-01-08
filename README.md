# Laravel API With TDD

## Config

- copy file `.env` then rename to `.env.testing`

- change `DB_DATABASE` to your database for testing in file `.env.testing`:

- set DB_CONNECTION in file `phpunit.xml`:

```php
    <server name="DB_CONNECTION" value="testing"/>
```

- add new connections in file `database.php`:

```php
'connections' => [
    'testing' => [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'database' => 'YourNameDBTesting', //adjust the name db with previous step
        'username' => 'YourUsernameDB',
        'password' => 'YourPassDB',
    ],

    // other connections
]
```

- load `.env.testing` in file `CreatesApplication.php`:

```php
<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->loadEnvironmentFrom('.env.testing'); // <--- this

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}

```
