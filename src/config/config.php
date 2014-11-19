<?php


    return array(

        'files'             => array(

            'model'                 => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/Model.txt'),
                'path'                  => app_path('models'),
                'name'                  => '##VALUE##.php'
            ),

            'controller'            => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/Controller.txt'),
                'path'                  => app_path('controllers'),
                'name'                  => '##VALUE##Controller.php'
            ),

            'controllerTest'        => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/ControllerTest.txt'),
                'path'                  => app_path('tests/unit/controllers'),
                'name'                  => '##VALUE##ControllerTest.php'
            ),

            'repository'            => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/Repository.txt'),
                'path'                  => app_path('repositories/Eloquent'),
                'name'                  => 'Eloquent##VALUE##Repository.php'
            ),

            'repositoryTest'        => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/RepositoryTest.txt'),
                'path'                  => app_path('tests/functional/repositories/Eloquent'),
                'name'                  => 'Eloquent##VALUE##RepositoryTest.php'
            ),

            'Factory'               => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/Factory.txt'),
                'path'                  => app_path('services/creation'),
                'name'                  => '##VALUE##Factory.php'
            ),

            'FactoryTest'           => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/FactoryTest.txt'),
                'path'                  => app_path('tests/functional/services/creation'),
                'name'                  => '##VALUE##FactoryTest.php'
            ),

            'viewFactory'           => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/ViewFactory.txt'),
                'path'                  => app_path('services/presentation'),
                'name'                  => '##VALUE##ViewFactory.php'
            ),

            'viewFactoryTest'       => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/ViewFactoryTest.txt'),
                'path'                  => app_path('tests/unit/services/presentation'),
                'name'                  => '##VALUE##ViewFactoryTest.php'
            ),

            'inputHelper'           => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/InputHelper.txt'),
                'path'                  => app_path('services/input'),
                'name'                  => '##VALUE##InputHelper.php'
            ),

            'formHelper'            => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/FormHelper.txt'),
                'path'                  => app_path('services/form'),
                'name'                  => '##VALUE##FormHelper.php'
            ),

            'formHelperTest'        => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/FormHelperTest.txt'),
                'path'                  => app_path('tests/unit/services/form'),
                'name'                  => '##VALUE##FormHelperTest.php'
            ),

            'validator'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/Validator.txt'),
                'path'                  => app_path('services/validation'),
                'name'                  => '##VALUE##Validator.php'
            ),

            'validatorTest'         => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/ValidatorTest.txt'),
                'path'                  => app_path('tests/unit/services/validation'),
                'name'                  => '##VALUE##ValidatorTest.php'
            ),

            'presenter'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/Presenter.txt'),
                'path'                  => app_path('presenters'),
                'name'                  => '##VALUE##Presenter.php'
            )
        ),

        'views'             => array(

            'indexView'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/IndexView.txt'),
                'name'                  => 'index.blade.php'
            ),

            'listView'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/ListView.txt'),
                'name'                  => 'list.blade.php'
            ),

            'tableView'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/TableView.txt'),
                'name'                  => 'table.blade.php'
            ),

            'showView'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/ShowView.txt'),
                'name'                  => 'show.blade.php'
            ),

            'createView'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/CreateView.txt'),
                'name'                  => 'create.blade.php'
            ),

            'editView'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/EditView.txt'),
                'name'                  => 'edit.blade.php'
            ),

            'formView'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/Ixudra/Generators/Templates/FormView.txt'),
                'name'                  => 'form.blade.php'
            ),
        )

    );