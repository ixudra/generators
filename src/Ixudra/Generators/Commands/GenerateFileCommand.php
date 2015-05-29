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
            $result = $this->generateFile( $file['template'], $file['name'], $file['path'] );
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

    protected function generateFile($template, $fileName, $path)
    {
        $file = $this->loadTemplate($template);
        $content = $this->replaceValues( $file );
        $this->createFile( $fileName, $path, $content );

        return true;
    }

    protected function getArguments()
    {
        return array(
            array('file', InputArgument::REQUIRED, 'Identifier of the file that needs to be generated', null),
            array('resource-singular', InputArgument::REQUIRED, 'Singular value of the resource', null),
            array('resource-plural', InputArgument::OPTIONAL, 'Plural value of the resource', null)
        );
    }

    protected function getFileKey()
    {
        return $this->argument('file');
    }

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
