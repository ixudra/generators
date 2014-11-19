Generators
==========

Custom PHP resource generation library for the Laravel 4 framework - developed by Ixudra.

This package can be used by anyone at any given time, but keep in mind that it is optimized for my personal custom workflow. It may not suit your project perfectly and modifications may be in order.




## Installation

Pull this package in through Composer.

```js

{
    "require": {
        "ixudra/generators": "1.0.*"
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

The command accepts 2 parameters. The first parameter is required and should be the singular name of your resource. The second parameter is optional and should the plural name of your resource. If the second parameter is not provided, the package will use the singular name value and add an `s` to it by default.

If you have a resource name that consists of multiple components, you should use underscores to connect the individual components (e.g. `product type` will become `product_type`). That way, the generator will be able to generate the correct constant names and table name for your resource.



## Configuration options

### Publishing the config file

The package has several configuration options. In order to modify these, you will have to publish the config file using artisan:

```php

    php artisan config:publish ixudra:generators

```

The config file will be published to `app/config/packages/ixudra/generators/config.php` where you will be able to make all modifications necessary to make it work with you application.


### Custom templates

As of version 1.0.0, the package also supports custom templates. These templates may contain 7 different variables that you can use to customize your development flow:


| Name                      | key                       | example: project  | example 2: product type   |
|---------------------------|---------------------------|-------------------|---------------------------|
| Table name                | ##TABLE_NAME##            | projects          | product_types             |
| class name singular       | ##CLASS_SINGULAR##        | Project           | ProductType               |
| class name plural         | ##CLASS_PLURAL##          | Projects          | ProductTypes              |
| variable name singular    | ##VARIABLE_SINGULAR##     | project           | productType               |
| variable name plural      | ##VARIABLE_PLURAL##       | projects          | productTypes              |
| constant name singular    | ##CONSTANT_SINGULAR##     | PROJECT           | PRODUCT_TYPE              |
| constant name plural      | ##CONSTANT_PLURAL##       | PROJECT           | PRODUCT_TYPES             |


You can store these anywhere you like on your system. To enable a custom template, all you need to do is change the path to the file in the package config file.


That's all there is to it! Have fun!