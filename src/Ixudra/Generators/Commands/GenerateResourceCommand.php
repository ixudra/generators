<?php namespace Ixudra\Generators\Commands;


use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class GenerateResourceCommand extends Command {

    protected $name = 'generate:resource';

    protected $description = 'Generate files for a resource based on a list of templates';

    protected $classSingular;
    protected $classPlural;

    protected $constantSingular;
    protected $constantPlural;

    protected $variableSingular;
    protected $variablePlural;

    protected $files;
    protected $views;


    public function __construct()
    {
        parent::__construct();

        $this->files = array(
            'model'                 => array(
                'template'              => 'Model.txt',
                'path'                  => app_path('models'),
                'name'                  => '##VALUE##.php'
            ),
            'controller'            => array(
                'template'              => 'Controller.txt',
                'path'                  => app_path('controllers'),
                'name'                  => '##VALUE##Controller.php'
            ),
            'controllerTest'        => array(
                'template'              => 'ControllerTest.txt',
                'path'                  => app_path('tests/unit/controllers'),
                'name'                  => '##VALUE##ControllerTest.php'
            ),
            'repository'            => array(
                'template'              => 'Repository.txt',
                'path'                  => app_path('repositories/Eloquent'),
                'name'                  => 'Eloquent##VALUE##Repository.php'
            ),
            'repositoryTest'        => array(
                'template'              => 'RepositoryTest.txt',
                'path'                  => app_path('tests/unit/repositories/Eloquent'),
                'name'                  => 'Eloquent##VALUE##RepositoryTest.php'
            ),
            'Factory'               => array(
                'template'              => 'Factory.txt',
                'path'                  => app_path('services/creation'),
                'name'                  => '##VALUE##Factory.php'
            ),
            'FactoryTest'           => array(
                'template'              => 'FactoryTest.txt',
                'path'                  => app_path('tests/unit/services/creation'),
                'name'                  => '##VALUE##FactoryTest.php'
            ),
            'viewFactory'           => array(
                'template'              => 'ViewFactory.txt',
                'path'                  => app_path('services/presentation'),
                'name'                  => '##VALUE##ViewFactory.php'
            ),
            'viewFactoryTest'       => array(
                'template'              => 'ViewFactoryTest.txt',
                'path'                  => app_path('tests/unit/services/presentation'),
                'name'                  => '##VALUE##ViewFactoryTest.php'
            ),
            'inputHelper'           => array(
                'template'              => 'InputHelper.txt',
                'path'                  => app_path('services/input'),
                'name'                  => '##VALUE##InputHelper.php'
            ),
            'formHelper'            => array(
                'template'              => 'FormHelper.txt',
                'path'                  => app_path('services/form'),
                'name'                  => '##VALUE##FormHelper.php'
            ),
            'formHelperTest'        => array(
                'template'              => 'FormHelperTest.txt',
                'path'                  => app_path('tests/unit/services/form'),
                'name'                  => '##VALUE##FormHelperTest.php'
            ),
            'validator'             => array(
                'template'              => 'Validator.txt',
                'path'                  => app_path('services/validation'),
                'name'                  => '##VALUE##Validation.php'
            ),
            'validatorTest'         => array(
                'template'              => 'ValidatorTest.txt',
                'path'                  => app_path('tests/unit/services/validation'),
                'name'                  => '##VALUE##ValidatorTest.php'
            ),
            'presenter'             => array(
                'template'              => 'Presenter.txt',
                'path'                  => app_path('presenters'),
                'name'                  => '##VALUE##Presenter.php'
            )
        );

        $this->views = array(
            'indexView'             => array(
                'template'              => 'IndexView.txt',
                'name'                  => 'index.blade.php'
            ),
            'listView'             => array(
                'template'              => 'ListView.txt',
                'name'                  => 'list.blade.php'
            ),
            'tableView'             => array(
                'template'              => 'TableView.txt',
                'name'                  => 'table.blade.php'
            ),
            'showView'             => array(
                'template'              => 'ShowView.txt',
                'name'                  => 'show.blade.php'
            ),
            'createView'             => array(
                'template'              => 'CreateView.txt',
                'name'                  => 'create.blade.php'
            ),
            'editView'             => array(
                'template'              => 'EditView.txt',
                'name'                  => 'edit.blade.php'
            ),
            'formView'             => array(
                'template'              => 'FormView.txt',
                'name'                  => 'form.blade.php'
            ),
        );
    }


    public function fire()
    {
        $this->deriveArguments();

        foreach( $this->files as $file ) {
            $template = $this->loadTemplate($file['template']);
            $content = $this->replaceValues( $template );
            $this->createFile( $file['name'], $file['path'], $content );
        }

        $path = app_path('views') . '/bootstrap/' . $this->variablePlural;
        $this->createDirectory($path);
        foreach( $this->views as $view ) {
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
        $this->variableSingular = strtolower( $this->argument('resource-singular') );
        $this->variablePlural = strtolower( $this->argument('resource-plural') );
        if( is_null($this->variablePlural) || empty($this->variablePlural) ) {
            $this->variablePlural = $this->variableSingular .'s';
        }

        $this->classSingular = ucfirst( $this->variableSingular );
        $this->classPlural = ucfirst( $this->variablePlural );

        $this->constantSingular = strtoupper( $this->variableSingular );
        $this->constantPlural = strtoupper( $this->variablePlural );
    }

    protected function replaceValues($template)
    {
        $template = str_replace( '##CLASS_SINGULAR##', $this->classSingular, $template );
        $template = str_replace( '##CLASS_PLURAL##', $this->classPlural, $template );
        $template = str_replace( '##CONSTANT_SINGULAR##', $this->constantSingular, $template );
        $template = str_replace( '##CONSTANT_PLURAL##', $this->constantPlural, $template );
        $template = str_replace( '##VARIABLE_SINGULAR##', $this->variableSingular, $template );
        $template = str_replace( '##VARIABLE_PLURAL##', $this->variablePlural, $template );

        return $template;
    }

    protected function loadTemplate($name)
    {
        $fileName = __DIR__.'/../Templates/'. $name;
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
