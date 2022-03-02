# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/amsoell/withable-sortable.svg?style=flat-square)](https://packagist.org/packages/amsoell/withable-sortable)
[![Total Downloads](https://img.shields.io/packagist/dt/amsoell/withable-sortable.svg?style=flat-square)](https://packagist.org/packages/amsoell/withable-sortable)

This Laravel package enables dynamic eager loading and sorting in your API controllers.

## Installation

You can install the package via composer:

```bash
composer require amsoell/withable-sortable
```

## Usage

Add the `withable()` and `sortable()` calls on any Eloquent queries in your API controllers to automatically enable eager loading and sorting through querystring parameters. An controllerless example:

```php
use Illuminate\Support\Facades\Route;

Route::get('/users', function () {
    $users = User::query()
        ->sortable()
        ->withable();

    return $users->paginate()->withQueryString();
});
```

 - `/users` will return users sorted by the default (`created_at` in ascending order)
 - `/users?sort=email` will return users sorted by email address
 - `/users?sort=email&direction=desc` will return users sorted by email in descending order
 - `/users?with=posts` will return users with a `posts` relationship eager loaded
 - `/users?with[]=posts&with[]=comments` will return users with `posts` and `comments` relationships both eager loaded

If you want to specifically eager load some relationships while allowing additional eager loads via `with=`, you can specify them in your route method:

```php
$users = User::query()->withable([
    'posts',
]);
```

You can also set the default sort parameters:

```php
$users = User::query()->sortable([
    'updated_at',
    'asc',
]);
```

Even when setting default eager loads or sorts, they can be added to or overridden via querystring paramters.

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email andy@teamsoell.com instead of using the issue tracker.

## Credits

-   [Andy Soell](https://github.com/amsoell)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
