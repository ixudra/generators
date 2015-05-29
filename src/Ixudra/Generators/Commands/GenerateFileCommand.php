<?php namespace Ixudra\Generators\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Str;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

use Config;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

class GenerateFileCommand extends BaseGenerateCommand {

    protected $name = 'generate:file';

    protected $description = 'Generate a single file for a resource based on a specific template';


    public function fire()
    {
        $result = false;
        $error = '';
        $fileKey = $this->getFileKey();

        $this->printStartMessage( $fileKey );

        try {
            $this->deriveArguments();
            if( !Config::has('generators.files.'. $fileKey) ) {
                throw new \InvalidArgumentException('No template found matching specified key '. $fileKey);
            }

            $file = Config::get('generators.files.'. $this->getFileKey() );

            $path = $this->option('path');
            if( is_null($path) ) {
                $path = $file[ 'path' ];
            }

            $result = $this->generateFile( $file[ 'template' ], $file[ 'name' ], $path );
        } catch(\Exception $e) {
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
        $this->tableName = strtolower( $this->getPluralResourceName() );

        $this->classSingular = $this->getSingularClassName();
        $this->classPlural = $this->getPluralClassName();

        $this->variableSingular = $this->getSingularVariableName();
        $this->variablePlural = $this->getPluralVariableName();

        $this->constantSingular = strtoupper( $this->getSingularResourceName() );
        $this->constantPlural = strtoupper( $this->getPluralResourceName() );
    }


    //- File generation ---

    protected function generateFile($template, $fileName, $path)
    {
        $file = $this->loadTemplate($template);
        $content = $this->replaceValues( $file );
        $this->createFile( $fileName, $path, $content );

        return true;
    }

    protected function loadTemplate($fileName)
    {
        if( !file_exists($fileName) ) {
            throw new \Exception('File not found: '. $fileName);
        }

        return file_get_contents( $fileName );
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

        $adminResourceFolderPath = '';
        $adminResourceDotPath = '';
        $adminNamespacePath = '';
        $adminClassPath = '';
        if( $this->isAdmin() ) {
            $adminResourceFolderPath = '/admin';
            $adminResourceDotPath = 'admin.';
            $adminNamespacePath = '\Admin';
            $adminClassPath = '/Admin';
        }

        $template = str_replace( '##ADMIN_RESOURCE_FOLDER_PATH##', $adminResourceFolderPath, $template );
        $template = str_replace( '##ADMIN_RESOURCE_DOT_PATH##', $adminResourceDotPath, $template );
        $template = str_replace( '##ADMIN_NAMESPACE_PATH##', $adminNamespacePath, $template );
        $template = str_replace( '##ADMIN_CLASS_PATH##', $adminClassPath, $template );

        return $template;
    }

    protected function createFile($name, $path, $content)
    {
        $path = $this->replaceValues( $path );
        $this->createDirectory( $path );

        $fileName = $path .'/'. str_replace( '##VALUE##', $this->classSingular, $name );
        if( file_exists($fileName) ) {
            if( !$this->allowOverwrite() ) {
                throw new \Exception('File '. str_replace( '##VALUE##', $this->classSingular, $name ) .' was not created - file already exists.');
            }

            unlink( $fileName );
        }

        if( !file_exists($path) ) {
            throw new \Exception('File '. str_replace( '##VALUE##', $this->classSingular, $name ) .' was not created - target directory does not exist.');
        }

        file_put_contents( $fileName, $content );
    }

    protected function createDirectory($path)
    {
        if( file_exists($path) ) {
            return;
        }

        mkdir($path, '0777', true);
    }


    //- Arguments and options ---

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
            array('path', null, InputOption::VALUE_OPTIONAL, 'The directory in which the file needs to be stored', null)
        );
    }

    protected function getFileKey()
    {
        return $this->argument('file');
    }


    //- User feedback ---

    protected function getVerbosity()
    {
        return $this->getOutput()->getVerbosity();
    }

    protected function printStartMessage($fileKey)
    {
        if( $this->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE ) {
            $this->info('Generating the '. $fileKey .' file...');
        }
    }

    protected function printSuccessMessage($fileKey)
    {
        if( $this->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE ) {
            $this->info('Successfully generated the '. $fileKey .' file!');
        } else if( $this->getVerbosity() >= OutputInterface::VERBOSITY_NORMAL ) {
            $this->output->write('.');
        }
    }

    protected function printErrorMessage($fileKey, $message)
    {
        if( $this->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE ) {
            $this->error('Failed generating the '. $fileKey .' file - '. $message .'!');
        } else if( $this->getVerbosity() >= OutputInterface::VERBOSITY_NORMAL ) {
            $this->output->write('<error>F</error>');
        }
    }

}
