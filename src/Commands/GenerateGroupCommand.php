<?php namespace Ixudra\Generators\Commands;


use InvalidArgumentException;
use Config;

class GenerateGroupCommand extends BaseGenerateCommand {

    protected $name = 'generate:group';

    protected $description = 'Generate a list of files for a resource';

    protected $signature = 'generate:group
                        {group : Identifier of the group that needs to be generated}
                        {resource-singular : Singular value of the resource}
                        {resource-plural? : Plural value of the resource}
                        {--admin : Move the controllers and view factories into an admin subdirectory}
                        {--allowOverwrite : Allow the generator to overwrite existing files}';


    public function handle()
    {
        $groupKey = $this->argument('group');
        if( !Config::has('generators.groups.'. $groupKey) ) {
            throw new InvalidArgumentException('No group found matching specified key '. $groupKey);
        }

        $files = Config::get('generators.groups.'. $groupKey );
        foreach( $files as $file ) {
            $this->generateFile( $file );
        }

        $this->info(' - Group files generated!');
    }

}
