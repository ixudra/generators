<?php namespace Ixudra\Generators\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Str;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

use Config;

class GenerateResourceCommand extends Command {

    protected $name = 'generate:resource';

    protected $description = 'Generate files for a resource based on a list of templates';

    protected $tableName;

    protected $classSingular;
    protected $classPlural;

    protected $constantSingular;
    protected $constantPlural;

    protected $variableSingular;
    protected $variablePlural;


    public function fire()
    {
        $this->deriveArguments();

        foreach( Config::get("generators::config.files") as $file ) {
            $template = $this->loadTemplate($file['template']);
            $content = $this->replaceValues( $template );
            $this->createFile( $file['name'], $file['path'], $content );
        }

        $path = app_path('views') . '/bootstrap/' . $this->variablePlural;
        $this->createDirectory($path);
        foreach( Config::get("generators::config.views") as $view ) {
            $template = $this->loadTemplate($view['template']);
            $content = $this->replaceValues( $template );
            $this->createFile( $view['name'], $path, $content );
        }
    }

    protected function getArguments()
    {
        return array(
            array('resource-singular', InputArgument::REQUIRED, 'Singular value of the resource', null),
            array('resource-plural', InputArgument::OPTIONAL, 'Plural value of the resource', null)
        );
    }

    protected function getOptions()
    {
        return array(
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
        $template = str_replace( '##TABLE_NAME##', $this->tableName, $template );
        $template = str_replace( '##CLASS_SINGULAR##', $this->classSingular, $template );
        $template = str_replace( '##CLASS_PLURAL##', $this->classPlural, $template );
        $template = str_replace( '##CONSTANT_SINGULAR##', $this->constantSingular, $template );
        $template = str_replace( '##CONSTANT_PLURAL##', $this->constantPlural, $template );
        $template = str_replace( '##VARIABLE_SINGULAR##', $this->variableSingular, $template );
        $template = str_replace( '##VARIABLE_PLURAL##', $this->variablePlural, $template );

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
                $this->error('File '. str_replace( '##VALUE##', $this->classSingular, $name ) .' was not created - target directory does not.');
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
            } else {
                $this->error('Directory '. $path .' was not created - directory already exists.');
                return;
            }
        }

        mkdir($path);
    }

    protected function allowOverwrite()
    {
        return $this->option('allowOverwrite') === 'true';
    }

    protected function failOnError()
    {
        return $this->option('failOnError') === 'true';
    }

}
