<?php namespace Ixudra\Generators;


use Illuminate\Support\ServiceProvider;
use Ixudra\Generators\Commands\GenerateResourceCommand;
use Ixudra\Generators\Commands\GenerateFileCommand;

class GeneratorsServiceProvider extends ServiceProvider {

    protected $defer = false;


    public function register()
    {
        $this->registerGenerateResourceCommand();

        $configPath = __DIR__ . '/../../config/config.php';

        $this->mergeConfigFrom($configPath, 'generators');

        $this->publishes(array(
            $configPath         => config_path('generators.php'),
        ), 'config');
    }

    public function boot()
    {
        $resourcePath = __DIR__ .'/../../resources/templates';

        $this->publishes(array(
                $resourcePath       => app_path('../resources/templates'),
        ), 'templates');
    }

    protected function registerGenerateResourceCommand()
    {
        $this->app['generate.resource'] = $this->app->share(
            function($app)
            {
                return new GenerateResourceCommand();
            }
        );
        $this->commands('generate.resource');

        $this->app['generate.file'] = $this->app->share(
            function($app)
            {
                return new GenerateFileCommand();
            }
        );
        $this->commands('generate.file');
    }

}
