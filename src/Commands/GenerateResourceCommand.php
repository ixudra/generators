<?php namespace Ixudra\Generators\Commands;


use Config;

class GenerateResourceCommand extends BaseGenerateCommand {

    protected $name = 'generate:resource';

    protected $description = 'Generate files for a resource based on a list of templates';

    protected $signature = 'generate:resource
                        {resource-singular : Singular value of the resource}
                        {resource-plural? : Plural value of the resource}
                        {--admin : Move the controllers and view factories into an admin subdirectory}
                        {--allowOverwrite : Allow the generator to overwrite existing files}';


    public function handle()
    {
        foreach( Config::get('generators.groups.resource') as $file ) {
            $this->generateFile( $file );
        }

        $this->info(' - Resource files generated!');
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

}
