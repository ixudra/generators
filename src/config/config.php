<?php


    return array(

        'namespace'         => 'App',


        'paths'             => array(

            'views'             => app_path('../resources/views') .'/bootstrap/',
            'requests'          => app_path('Http/Requests') .'/'

        ),


        'files'             => array(

            'model'                 => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/Model.txt'),
                'path'                  => app_path('Models'),
                'name'                  => '##VALUE##.php'
            ),

            'controller'            => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/Controller.txt'),
                'path'                  => app_path('Http/Controllers'),
                'name'                  => '##VALUE##Controller.php'
            ),

            'controllerTest'        => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ControllerTest.txt'),
                'path'                  => app_path('../tests/unit/Http/Controllers'),
                'name'                  => '##VALUE##ControllerTest.php'
            ),

            'repository'            => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/Repository.txt'),
                'path'                  => app_path('Repositories/Eloquent'),
                'name'                  => 'Eloquent##VALUE##Repository.php'
            ),

            'repositoryTest'        => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/RepositoryTest.txt'),
                'path'                  => app_path('../tests/functional/Repositories/Eloquent'),
                'name'                  => 'Eloquent##VALUE##RepositoryTest.php'
            ),

            'Factory'               => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/Factory.txt'),
                'path'                  => app_path('Services/Factories'),
                'name'                  => '##VALUE##Factory.php'
            ),

            'FactoryTest'           => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FactoryTest.txt'),
                'path'                  => app_path('../tests/functional/Services/Factories'),
                'name'                  => '##VALUE##FactoryTest.php'
            ),

            'viewFactory'           => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ViewFactory.txt'),
                'path'                  => app_path('Services/Html'),
                'name'                  => '##VALUE##ViewFactory.php'
            ),

            'viewFactoryTest'       => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ViewFactoryTest.txt'),
                'path'                  => app_path('../tests/unit/Services/Html'),
                'name'                  => '##VALUE##ViewFactoryTest.php'
            ),

            'inputHelper'           => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/InputHelper.txt'),
                'path'                  => app_path('Services/Input'),
                'name'                  => '##VALUE##InputHelper.php'
            ),

            'inputHelperTest'       => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/InputHelperTest.txt'),
                'path'                  => app_path('../tests/unit/Services/Input'),
                'name'                  => '##VALUE##InputHelper.php'
            ),

            'formHelper'            => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FormHelper.txt'),
                'path'                  => app_path('Services/Form'),
                'name'                  => '##VALUE##FormHelper.php'
            ),

            'formHelperTest'        => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FormHelperTest.txt'),
                'path'                  => app_path('../tests/unit/Services/Form'),
                'name'                  => '##VALUE##FormHelperTest.php'
            ),

            'presenter'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/Presenter.txt'),
                'path'                  => app_path('Presenters'),
                'name'                  => '##VALUE##Presenter.php'
            ),

        ),


        'requests'          => array(

            'createFormRequest'     => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/CreateFormRequest.txt'),
                'name'                  => 'Create##VALUE##FormRequest.php'
            ),

            'updateFormRequest'     => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/UpdateFormRequest.txt'),
                'name'                  => 'Update##VALUE##FormRequest.php'
            ),

            'filterFormRequest'     => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FilterFormRequest.txt'),
                'name'                  => 'Filter##VALUE##FormRequest.php'
            )
        ),


        'views'             => array(

            'indexView'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/IndexView.txt'),
                'name'                  => 'index.blade.php'
            ),

            'listView'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ListView.txt'),
                'name'                  => 'list.blade.php'
            ),

            'tableView'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/TableView.txt'),
                'name'                  => 'table.blade.php'
            ),

            'showView'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ShowView.txt'),
                'name'                  => 'show.blade.php'
            ),

            'createView'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/CreateView.txt'),
                'name'                  => 'create.blade.php'
            ),

            'editView'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/EditView.txt'),
                'name'                  => 'edit.blade.php'
            ),

            'formView'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FormView.txt'),
                'name'                  => 'form.blade.php'
            ),

            'filterView'           => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FilterView.txt'),
                'name'                  => 'filter.blade.php'
            ),
        )

    );