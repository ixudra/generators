<?php namespace Ixudra\Generators;


use Illuminate\Support\ServiceProvider;
use Ixudra\Generators\Commands\GenerateResourceCommand;

class GeneratorsServiceProvider extends ServiceProvider {

    protected $defer = false;


    public function boot()
    {
        $this->package('ixudra/generators');
    }

    public function register()
    {
        $this->registerGenerateResourceCommand();
    }

    protected function registerGenerateResourceCommand()
    {
        $this->app['generate.resource'] = $this->app->share(function($app)
        {
            return new GenerateResourceCommand();
        });

        $this->commands('generate.resource');
    }

    public function provides()
    {
        return array();
    }

}
