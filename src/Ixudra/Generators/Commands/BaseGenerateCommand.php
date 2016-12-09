<?php namespace Ixudra\Generators\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Str;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

use Config;
use Symfony\Component\HttpFoundation\ParameterBag;

abstract class BaseGenerateCommand extends Command {

    protected $tableName;

    protected $classSingular;
    protected $classPlural;

    protected $constantSingular;
    protected $constantPlural;

    protected $variableSingular;
    protected $variablePlural;

    protected $messages;


    public function __construct()
    {
        parent::__construct();

        $this->messages = new ParameterBag();
    }


    //- Value deduction ---

    protected function getSingularResourceName()
    {
        return $this->argument('resource-singular');
    }

    protected function getPluralResourceName()
    {
        $tableNamePlural = $this->argument('resource-plural');
        if( is_null($tableNamePlural) || empty($tableNamePlural) ) {
            $tableNamePlural = $this->getSingularResourceName().'s';
        }

        return $tableNamePlural;
    }

    protected function getSingularClassName()
    {
        return Str::studly( $this->argument('resource-singular') );
    }

    protected function getPluralClassName()
    {
        $classPlural = Str::studly( $this->argument('resource-plural') );
        if( is_null($classPlural) || empty($classPlural) ) {
            $classPlural = $this->getSingularClassName() .'s';
        }

        return $classPlural;
    }

    protected function getSingularVariableName()
    {
        return lcfirst( $this->getSingularClassName() );
    }

    protected function getPluralVariableName()
    {
        return lcfirst( $this->getPluralClassName() );
    }

    protected function generateFile($key, $path = null)
    {
        $this->call('generate:file',
            array(
                'file'              => $key,
                'resource-singular' => $this->argument('resource-singular'),
                'resource-plural'   => $this->argument('resource-plural'),
                '--admin'           => $this->option('admin'),
                '--allowOverwrite'  => $this->option('allowOverwrite'),
                '--path'            => $path,
            )
        );
    }



    //- Error reporting ---

    protected function addError($message)
    {
        $this->messages->add(
            array(
                'error'     => $message
            )
        );
    }

}
