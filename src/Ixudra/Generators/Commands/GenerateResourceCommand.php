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
        $this->deriveArguments();

        foreach( Config::get('generators.files') as $file ) {
            $this->generateFile( $file['template'], $file['name'], $file['path'] );
        }

        $viewDirectoryPath = Config::get('generators.paths.views') . $this->variablePlural;
        $this->createDirectory($viewDirectoryPath);

        foreach( Config::get('generators.views') as $view ) {
            $this->generateFile( $view['template'], $view['name'], $viewDirectoryPath );
        }

        $requestDirectoryPath = Config::get('generators.paths.requests') . $this->classPlural;
        $this->createDirectory($requestDirectoryPath);

        foreach( Config::get('generators.requests') as $view ) {
            $this->generateFile( $view['template'], $view['name'], $requestDirectoryPath );
        }

        $this->info('Resources generated!');
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
            array('resource-singular', InputArgument::REQUIRED, 'Singular value of the resource', null),
            array('resource-plural', InputArgument::OPTIONAL, 'Plural value of the resource', null)
        );
    }

}
