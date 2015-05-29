<?php namespace Ixudra\Generators\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Str;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

use Config;

class GenerateResourceCommand extends BaseGenerateCommand {

    protected $name = 'generate:resource';

    protected $description = 'Generate files for a resource based on a list of templates';


    public function fire()
    {
        foreach( Config::get('generators.files') as $key => $file ) {
            $this->generateFile( $key );
        }

        $this->info('Resources generated!');
    }

    protected function getArguments()
    {
        return array(
            array('resource-singular', InputArgument::REQUIRED, 'Singular value of the resource', null),
            array('resource-plural', InputArgument::OPTIONAL, 'Plural value of the resource', null)
        );
    }

    protected function generateFile($key, $path = null)
    {
        $this->call('generate:file',
            array(
                'file'              => $key,
                'resource-singular' => $this->argument('resource-singular'),
                'resource-plural'   => $this->argument('resource-plural'),
                '--isAdmin'         => $this->option('isAdmin'),
                '--allowOverwrite'  => $this->option('allowOverwrite'),
                '--path'            => $path,
            )
        );
    }

}
