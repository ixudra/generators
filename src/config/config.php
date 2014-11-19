<?php


    return array(

        'templates'         => array(

            'path'                  => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/')

        ),

        'files'             => array(

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
                'path'                  => app_path('tests/functional/repositories/Eloquent'),
                'name'                  => 'Eloquent##VALUE##RepositoryTest.php'
            ),

            'Factory'               => array(
                'template'              => 'Factory.txt',
                'path'                  => app_path('services/creation'),
                'name'                  => '##VALUE##Factory.php'
            ),

            'FactoryTest'           => array(
                'template'              => 'FactoryTest.txt',
                'path'                  => app_path('tests/functional/services/creation'),
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
                'name'                  => '##VALUE##Validator.php'
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
        ),

        'views'             => array(

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
        )

    );