[![Next](https://raw.githubusercontent.com/we-were-next/next-cms/master/logo-next-74x28.png)](https://github.com/we-were-next)

## Next CMS

### Installation

Next CMS can be integrated into any Laravel 5.1 project by simply adding the [Service Provider](https://laravel.com/docs/5.1/packages#service-providers) to your project config/app.php.

To download the CMS package and add it to your Composer's dependency list run this command:

```sh
composer require wewerenext/next-cms
```

Add this provider to your Laravel projects `config/app.php` file, at the end of the `'providers' => [` array:

```php
        Wearenext\CMS\ServiceProvider::class,
    ],
```

*Important:* Add these two lines to the `'aliases' => [` array near the end of that same file:

```php
        'CMSHtml'   => Wearenext\CMS\Support\Facades\HtmlFacade::class,
        'CMSForm'   => Wearenext\CMS\Support\Facades\FormFacade::class,
    ],
```

Final step is to publish all database migrations and public facing assets into your Laravel project. Run these two commands and optionally commit them to your projects code-base:

```sh
php artisan vendor:publish --tag=database
php artisan vendor:publish --tag=public
```

### Customization

Customizable attributes in the CMS can modified by overriding configuration directives set in `config/cms.php`. By default the configuration file looks like this:

```php
return [
    'group' => [
        'prefix' => 'admin', // You can access the CMS by appending /admin to your projects URL
    ],
    'brand' => [
        'color' => '#737373', // Color in menu bar
        'title' => 'Wearenext-CMS',  // Brand name in menu bar
    ],
    'auth' => [
        'middleware' => 'auth', // How authentication is checked for protected routes
    ],
];
```

### Testing

You can scan the source code for most errors including PSR adherence by running either of these two Composer scripts:

```sh
composer test-source # Scan for PSR and PHP errors
composer test # Scan for errors and run phpunit tests
```
