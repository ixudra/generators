<?php namespace Ixudra\Generators;


use Illuminate\Support\ServiceProvider;
use Ixudra\Generators\Commands\GenerateResourceCommand;

class GeneratorsServiceProvider extends ServiceProvider {

    protected $defer = false;


    public function register()
    {
        $this->registerGenerateResourceCommand();

        $configPath = __DIR__ . '/../../config/config.php';
        $resourcePath = __DIR__ .'/../../resources/templates';

        $this->mergeConfigFrom($configPath, 'generators');
        $this->publishes(
            array(
                $configPath         => config_path('generators.php'),
                $resourcePath       => app_path('../resources/templates'),
            )
        );
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
    }

}
