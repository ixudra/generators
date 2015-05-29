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


    protected function generateFile($template, $fileName, $path)
    {
        $file = $this->loadTemplate($template);
        $content = $this->replaceValues( $file );
        $this->createFile( $fileName, $path, $content );
    }

    protected function getArguments()
    {
        return array(
            array('file', InputArgument::REQUIRED, 'Identifier of the file that needs to be generated', null),
            array('resource-singular', InputArgument::REQUIRED, 'Singular value of the resource', null),
            array('resource-plural', InputArgument::OPTIONAL, 'Plural value of the resource', null)
        );
    }

    protected function getOptions()
    {
        return array(
            array('isAdmin', null, InputOption::VALUE_OPTIONAL, 'Move the controllers and view factories into an admin subdirectory', 'false'),
            array('allowOverwrite', null, InputOption::VALUE_OPTIONAL, 'Allow the generator to overwrite existing files', 'false'),
            array('failOnError', null, InputOption::VALUE_OPTIONAL, 'Halt the execution if an error is occurred', 'false')
        );
    }

    protected function deriveArguments()
    {
        $this->tableName = strtolower( $this->getPluralResourceName() );

        $this->classSingular = $this->getSingularClassName();
        $this->classPlural = $this->getPluralClassName();

        $this->variableSingular = lcfirst( $this->classSingular );
        $this->variablePlural = lcfirst( $this->classPlural );

        $this->constantSingular = strtoupper( $this->getSingularResourceName() );
        $this->constantPlural = strtoupper( $this->getPluralResourceName() );
    }

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
            $classPlural = $this->classSingular .'s';
        }

        return $classPlural;
    }

    protected function replaceValues($template)
    {
        $template = str_replace( '##NAMESPACE##', Config::get('generators.namespace'), $template );
        $template = str_replace( '##TABLE_NAME##', $this->tableName, $template );
        $template = str_replace( '##CLASS_SINGULAR##', $this->classSingular, $template );
        $template = str_replace( '##CLASS_PLURAL##', $this->classPlural, $template );
        $template = str_replace( '##CONSTANT_SINGULAR##', $this->constantSingular, $template );
        $template = str_replace( '##CONSTANT_PLURAL##', $this->constantPlural, $template );
        $template = str_replace( '##VARIABLE_SINGULAR##', $this->variableSingular, $template );
        $template = str_replace( '##VARIABLE_PLURAL##', $this->variablePlural, $template );

        $admin = '';
        if( $this->isAdmin() ) {
            $admin = '\Admin';
        }

        $template = str_replace( '##ADMIN##', $admin, $template );

        return $template;
    }

    protected function loadTemplate($fileName)
    {
        if( !file_exists($fileName) ) {
            if( $this->failOnError() ) {
                throw new \Exception('File not found: '. $fileName);
            } else {
                $this->error('File not found: '. $fileName);
                return null;
            }
        }

        return file_get_contents($fileName);
    }

    protected function createFile($name, $path, $content)
    {
        $pathSuffix = '';
        if( $this->isAdmin() ) {
            $pathSuffix = '/Admin';
        }
        $path = str_replace( '##ADMIN##', $pathSuffix, $path );

        $fileName = $path .'/'. str_replace( '##VALUE##', $this->classSingular, $name );
        if( file_exists($fileName) ) {
            if( $this->allowOverwrite() ) {
                unlink($fileName);
            } else if( $this->failOnError() ) {
                throw new \Exception('File already exists: '. $fileName);
            } else {
                $this->error('File '. str_replace( '##VALUE##', $this->classSingular, $name ) .' was not created - file already exists.');
                return;
            }
        }

        if( !file_exists($path) ) {
            if( $this->failOnError() ) {
                throw new \Exception('Target directory does not exist: '. $fileName);
            } else {
                $this->error('File '. str_replace( '##VALUE##', $this->classSingular, $name ) .' was not created - target directory does not exist.');
                return;
            }
        }

        file_put_contents($fileName, $content);
    }

    protected function createDirectory($path)
    {
        if( file_exists($path) ) {
            if( $this->failOnError() ) {
                throw new \Exception('Directory already exists: '. $path);
            }

            return;
        }

        mkdir($path);
    }

    protected function isAdmin()
    {
        return $this->option('isAdmin') === 'true';
    }

    protected function allowOverwrite()
    {
        return $this->option('allowOverwrite') === 'true';
    }

    protected function failOnError()
    {
        return $this->option('failOnError') === 'true';
    }

    protected function addError($message)
    {
        $this->messages->add(
            array(
                'error'     => $message
            )
        );
    }

}
