Config manager for open-developer
## Screenshot

![config screenshot](https://open-developer.org/docs/images/screenshots/ext-config.png)

## Installation

```
composer require open-developer-ext/config
```

```
php artisan migrate
```

Open `app/Providers/AppServiceProvider.php`, and call the `Config::load()` method within the `boot` method:

```php
<?php

namespace App\Providers;

use OpenDeveloper\Developer\Config\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $table = config('developer.extensions.config.table', 'developer_config');
        if (Schema::hasTable($table)) {
            Config::load();
        }
    }
}
```

Then run: 

```
php artisan developer:import config
```

Open `http://your-host/developer/config`

## Usage

After add config in the panel, use `config($key)` to get value you configured.
