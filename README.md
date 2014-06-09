Generators
==========

Custom PHP resource generation library for the Laravel 4 framework - developed by Ixudra.

This package can be used by anyone at any given time, but keep in mind that it is optimized for my personal custom workflow. It may not suit your project perfectly and modifications may be in order.




## Installation

Pull this package in through Composer.

```js
{
    "require": {
        "ixudra/generators": "0.1.*"
    }
}
```

Add the service provider to your app.php file

```php
    providers     => array(

        //...
        'Ixudra\Generators\GeneratorsServiceProvider',
    )
```




## Usage

The package provides one artisan command which you can use to generate a variety of resource files. To run the command, type the following into your CLI:

```php
    php artisan generate:resource foo bar
```

The command accepts 2 parameters. The first parameter is required and should be the singular name of your resource. The second parameter is optional and should the plural name of your resource. If the second parameter is not provides, the package will use the singular name value and add an `s` to it by default.


That's all there is to it! Have fun!