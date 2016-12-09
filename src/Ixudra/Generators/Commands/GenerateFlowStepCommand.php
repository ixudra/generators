<?php namespace Ixudra\Generators\Commands;


use Illuminate\Support\Str;

use InvalidArgumentException;
use Exception;
use Config;

class GenerateFlowStepCommand extends GenerateGroupCommand {

    protected $name = 'generate:flow-step';

    protected $description = 'Generate a flow based on a specific template';

    protected $signature = 'generate:flow
                        {flow : Name of the flow}
                        {step : Name of the flow step (does not apply to all files)}
                        {--allowOverwrite : Allow the generator to overwrite existing files}';


    public function fire()
    {
        foreach( Config::get('generators.groups.flowStep') as $file ) {
            $this->generateFile( $file );
        }

        $this->info(' - Flow step files generated!');
    }

    protected function generateFile($key, $path = null)
    {
        $this->call('generate:flow-file',
            array(
                'file'              => $key,
                'flow'              => $this->argument('flow'),
                'step'              => $this->argument('step'),
                '--allowOverwrite'  => $this->option('allowOverwrite'),
            )
        );
    }

}
