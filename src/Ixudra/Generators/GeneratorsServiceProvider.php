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
        $this->app->singleton( 'command.ixudra.generate.resource', function($app) {
                return $app[ 'Ixudra\Generators\Commands\GenerateResourceCommand' ];
            }
        );
        $this->commands('command.ixudra.generate.resource');

        $this->app->singleton( 'command.ixudra.generate.group', function($app) {
                return $app[ 'Ixudra\Generators\Commands\GenerateGroupCommand' ];
            }
        );
        $this->commands('command.ixudra.generate.group');

        $this->app->singleton( 'command.ixudra.generate.file', function($app) {
                return $app[ 'Ixudra\Generators\Commands\GenerateFileCommand' ];
            }
        );
        $this->commands('command.ixudra.generate.file');

        $this->app->singleton( 'command.ixudra.generate.flow', function($app) {
                return $app[ 'Ixudra\Generators\Commands\GenerateFlowCommand' ];
            }
        );
        $this->commands('command.ixudra.generate.flow');

        $this->app->singleton( 'command.ixudra.generate.flowStep', function($app) {
                return $app[ 'Ixudra\Generators\Commands\GenerateFlowStepCommand' ];
            }
        );
        $this->commands('command.ixudra.generate.flowStep');

        $this->app->singleton( 'command.ixudra.generate.flowFile', function($app) {
                return $app[ 'Ixudra\Generators\Commands\GenerateFlowFileCommand' ];
            }
        );
        $this->commands('command.ixudra.generate.flowFile');
    }

}
