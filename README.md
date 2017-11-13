ixudra/generators
========================

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ixudra/generators.svg?style=flat-square)](https://packagist.org/packages/ixudra/generators)
[![license](https://img.shields.io/github/license/ixudra/generators.svg)]()
[![StyleCI](https://styleci.io/repos/20149394/shield)](https://styleci.io/repos/20149394)
[![Total Downloads](https://img.shields.io/packagist/dt/ixudra/generators.svg?style=flat-square)](https://packagist.org/packages/ixudra/generators)

Custom PHP resource generation library for the Laravel 5 framework - developed by [Ixudra](http://ixudra.be).

This package can be used by anyone at any given time, but keep in mind that it is optimized for my personal custom workflow. It may not suit your project perfectly and modifications may be in order.




## Installation

Pull this package in through Composer:

```js

    {
        "require": {
            "ixudra/generators": "6.*"
        }
    }

```

Add the service provider to your app.php file:

```php

    'providers'         => array(

        //...
        \Ixudra\Generators\GeneratorsServiceProvider::class,

    )

```




## Usage

The package provides two artisan commands which you can use to generate a variety of resource files. The first command allows you generate a single file based on the specified template:

```php

    php artisan generate:file fileType resourceSingular resourcePlural

```

The command accepts 3 parameters: 

 - `fileType`: identifier of the file that needs to be generated - required
 - `resourceSingular`: the singular name of your resource - required
 - `resourcePlural`: the plural name of your resource - optional
 
The file type parameter needs to match a key that is available in the package configuration file. Some examples that are available by default are `Model`, `Controller`, `ControllerTest`, ...
 
If the resource plural parameter is not provided, the package will use the singular name value and add an `s` to it by default.

If you have a resource name that consists of multiple components, you should use underscores to connect the individual components (e.g. `product type` will become `product_type`). That way, the generator will be able to generate the correct constant names and table name for your resource.

Instead of generating a single file, you can also generate all files which are listed in the package configuration file:

```php

    php artisan generate:resource resourceSingular resourcePlural

```

The command parameters are identical to those of the `generate:file` command.




## Configuration options

### Publishing the config file

The package has several configuration options. In order to modify these, you will have to publish the config file using artisan:

```php

    // Publish all resources from all packages
    php artisan vendor:publish
    
    // Publish the package config file
    php artisan vendor:publish --provider="Ixudra\\Generators\\GeneratorsServiceProvider" --tag="config"
    
    // Publish the package templates
    php artisan vendor:publish --provider="Ixudra\\Generators\\GeneratorsServiceProvider" --tag="templates"

```

The config file will be published to `app/config/generators.php` where you will be able to make all modifications necessary to make it work with you application.


### Custom templates

As of version 1.0.0, the package also supports custom templates. These templates may contain 8 different variables that you can use to customize your development flow:


| Resource name             | Key                       | Example 1: project    | Example 2: product_type   |
|---------------------------|---------------------------|-----------------------|---------------------------|
| Application namespace     | ##NAMESPACE##             | App                   | App                       |
| Table name                | ##TABLE_NAME##            | projects              | product_types             |
| class name singular       | ##CLASS_SINGULAR##        | Project               | ProductType               |
| class name plural         | ##CLASS_PLURAL##          | Projects              | ProductTypes              |
| variable name singular    | ##VARIABLE_SINGULAR##     | project               | productType               |
| variable name plural      | ##VARIABLE_PLURAL##       | projects              | productTypes              |
| constant name singular    | ##CONSTANT_SINGULAR##     | PROJECT               | PRODUCT_TYPE              |
| constant name plural      | ##CONSTANT_PLURAL##       | PROJECT               | PRODUCT_TYPES             |


All variables except the namespace are determined automatically based on the parameters which are passed along to the command when called. The namespace can be set in the package `config.php` files after it has been published.

Using the previously mentioned `vendor:publish` command will also publish the default package templates into the `/resources/templates` directory within your Laravel application directory. However, you can store them anywhere you like on your system. To enable a custom template, all you need to do is change the path to the file in the package config file.


### Admin option

The package also allows for you to generate a file or resource specifically for the admin backend. This can be done by adding the `--admin` option to the `generate:resource` or `generate:file` commands. There are 4 different parameters that can be used to modify the templates for the admin backend:


| Name                      | Key                               | Value if printed      |
|---------------------------|-----------------------------------|-----------------------|
| resource folder path      | ##ADMIN_RESOURCE_FOLDER_PATH##    | /admin                |
| resource dot path         | ##ADMIN_RESOURCE_DOT_PATH##       | admin.                |
| namespace path            | ##ADMIN_NAMESPACE_PATH##          | \Admin                |
| class path                | ##ADMIN_CLASS_PATH##              | /Admin                |
| url path                  | ##ADMIN_URL_PATH##                | admin/                |


If the `--admin` flag is not provided, the admin variables will be ignored and replace with empty strings.


### Test option

Additionally, you can also add a `--test` option to the `generate:file` command. When applied, the package will also generate the appropriate test class that comes with the resource. 


That's all there is to it! Have fun!




## Support

Help me further develop and maintain this package by supporting me via [Patreon](https://www.patreon.com/ixudra)!!




## License

This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)




## Contact

For package questions, bug, suggestions and/or feature requests, please use the Github issue system and/or submit a pull request. When submitting an issue, always provide a detailed explanation of your problem, any response or feedback your get, log messages that might be relevant as well as a source code example that demonstrates the problem. If not, I will most likely not be able to help you with your problem. Please review the [contribution guidelines](https://github.com/ixudra/generators/blob/master/CONTRIBUTING.md) before submitting your issue or pull request.

For any other questions, feel free to use the credentials listed below: 

Jan Oris (developer)

- Email: jan.oris@ixudra.be
- Telephone: +32 496 94 20 57