# api-crud-generator
Automatic controller generator for Laravel based on the existing models in your project. You can get the default methods (store, update, destroy, show and index) in a controller and with default content for an API project just by executing:

` php artisan crud:generate `

## Installation

Use composer to install this package:

```sh
$ composer require ur13l\api-crud-generator
```

You will need to add the service provider on your `config/app.php` file:

```php
Ur13l\ApiCrudGenerator\Providers\ApiCrudGeneratorProvider::class,
```

