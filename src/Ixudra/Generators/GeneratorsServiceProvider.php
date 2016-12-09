<?php namespace Ixudra\Generators;


use Illuminate\Support\ServiceProvider;
use Ixudra\Generators\Commands\GenerateResourceCommand;
use Ixudra\Generators\Commands\GenerateGroupCommand;
use Ixudra\Generators\Commands\GenerateFileCommand;
use Ixudra\Generators\Commands\GenerateFlowCommand;
use Ixudra\Generators\Commands\GenerateFlowStepCommand;
use Ixudra\Generators\Commands\GenerateFlowFileCommand;

class GeneratorsServiceProvider extends ServiceProvider {

    protected $defer = false;


    public function register()
    {
        $this->registerCommands();

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

    protected function registerCommands()
    {
        $this->app['generate.resource'] = $this->app->share(
            function($app)
            {
                return new GenerateResourceCommand();
            }
        );
        $this->commands('generate.resource');

        $this->app['generate.group'] = $this->app->share(
            function($app)
            {
                return new GenerateGroupCommand();
            }
        );
        $this->commands('generate.group');

        $this->app['generate.file'] = $this->app->share(
            function($app)
            {
                return new GenerateFileCommand();
            }
        );
        $this->commands('generate.file');

        $this->app['generate.flow'] = $this->app->share(
            function($app)
            {
                return new GenerateFlowCommand();
            }
        );
        $this->commands('generate.flow');

        $this->app['generate.flowStep'] = $this->app->share(
            function($app)
            {
                return new GenerateFlowStepCommand();
            }
        );
        $this->commands('generate.flowStep');

        $this->app['generate.flowFile'] = $this->app->share(
            function($app)
            {
                return new GenerateFlowFileCommand();
            }
        );
        $this->commands('generate.flowFile');
    }

}
