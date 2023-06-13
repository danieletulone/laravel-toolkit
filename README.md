# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/danieletulone/laravel-toolkit.svg?style=flat-square)](https://packagist.org/packages/danieletulone/laravel-toolkit)
[![Total Downloads](https://img.shields.io/packagist/dt/danieletulone/laravel-toolkit.svg?style=flat-square)](https://packagist.org/packages/danieletulone/laravel-toolkit)
![GitHub Actions](https://github.com/danieletulone/laravel-toolkit/actions/workflows/main.yml/badge.svg)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require danieletulone/laravel-toolkit
```

## Usage

### Disable Primary Key

Useful for disable the primary key requirement. This is useful for when you want to migrate tables in a db service the Digital Ocean's one.

Register the DisablePrimaryKeyRequirement listener for MigrationStarted event in App\Providers\EventServiceProvider:

1. Add the use:

```php
use App\Listeners\DisablePrimaryKeyRequirement;
use Illuminate\Database\Events\MigrationStarted;
```

2. Add this lines in $listen array:
```php
MigrationStarted::class => [
    DisablePrimaryKeyRequirement::class,
]
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email danieletulone.work@gmail.com instead of using the issue tracker.

## Credits

-   [Daniele Tulone](https://github.com/danieletulone)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
