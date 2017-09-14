<?php namespace Ixudra\Generators\Commands;


use Illuminate\Support\Str;

use InvalidArgumentException;
use Exception;
use Config;

class GenerateFlowFileCommand extends GenerateFileCommand {

    protected $name = 'generate:flow-file';

    protected $description = 'Generate a file for a flow based on a specific template';

    protected $signature = 'generate:flow-file
                        {file : Identifier of the file that needs to be generated}
                        {flow : Name of the flow}
                        {step? : Name of the flow step (does not apply to all files)}
                        {--allowOverwrite : Allow the generator to overwrite existing files}
                        {--path= : The directory in which the file needs to be stored}';

    protected $flowClass;
    protected $flowVariable;

    protected $stepClass;
    protected $stepVariable;
    protected $stepBreadcrumb;


    public function handle()
    {
        $result = false;
        $error = '';
        $fileKey = $this->argument('file');

        $this->printStartMessage( $fileKey );

        try {
            $this->deriveArguments();
            if( !Config::has('generators.files.'. $fileKey) ) {
                throw new InvalidArgumentException('No template found matching specified key '. $fileKey);
            }

            $file = Config::get('generators.files.'. $fileKey );

            $path = $this->option('path');
            if( is_null($path) ) {
                $path = $file[ 'path' ];
            }

            $result = $this->generateFromTemplate( $file[ 'template' ], $file[ 'name' ], $path );
        } catch(Exception $e) {
            $error = $e->getMessage();
            $this->addError( $error );
        }

        if( $result ) {
            $this->printSuccessMessage( $fileKey );
        } else {
            $this->printErrorMessage( $fileKey, $error );
        }
    }


    //- Value deduction ---

    protected function deriveArguments()
    {
        $this->flowClass = Str::studly( $this->argument('flow') );
        $this->flowVariable = lcfirst( Str::studly( $this->argument('flow') ) );

        $this->stepClass = Str::studly( $this->argument('step') );
        $this->stepVariable = lcfirst( Str::studly( $this->argument('step') ) );
        $this->stepBreadcrumb = str_replace( '_', '-', $this->argument('step') );
    }


    //- File generation ---

    protected function replaceValues($template)
    {
        $template = str_replace( '##NAMESPACE##', Config::get('generators.namespace'), $template );
        $template = str_replace( '##FLOW_CLASS##', $this->flowClass, $template );
        $template = str_replace( '##FLOW_VARIABLE##', $this->flowVariable, $template );
        $template = str_replace( '##FLOW_STEP_CLASS##', $this->stepClass, $template );
        $template = str_replace( '##FLOW_STEP_VARIABLE##', $this->stepVariable, $template );
        $template = str_replace( '##FLOW_STEP_BREADCRUMB##', $this->stepBreadcrumb, $template );

        return $template;
    }

}
