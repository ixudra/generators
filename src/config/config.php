<?php


    return array(

        'namespace'         => 'App',


        'files'             => array(

            'model'                 => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/Model.txt'),
                'path'                  => app_path('Models'),
                'name'                  => '##VALUE##.php'
            ),

            'controller'            => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/Controller.txt'),
                'path'                  => app_path('Http/Controllers') .'/##ADMIN_CLASS_PATH##',
                'name'                  => '##VALUE##Controller.php'
            ),

            'controllerTest'        => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ControllerTest.txt'),
                'path'                  => app_path('../tests/unit/Http/Controllers') .'/##ADMIN_CLASS_PATH##',
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

            'factory'               => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/Factory.txt'),
                'path'                  => app_path('Services/Factories'),
                'name'                  => '##VALUE##Factory.php'
            ),

            'factoryTest'           => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FactoryTest.txt'),
                'path'                  => app_path('../tests/functional/Services/Factories'),
                'name'                  => '##VALUE##FactoryTest.php'
            ),

            'viewFactory'           => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ViewFactory.txt'),
                'path'                  => app_path('Services/Html') .'##ADMIN_CLASS_PATH##',
                'name'                  => '##VALUE##ViewFactory.php'
            ),

            'viewFactoryTest'       => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ViewFactoryTest.txt'),
                'path'                  => app_path('../tests/unit/Services/Html') .'/##ADMIN_CLASS_PATH##',
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
                'name'                  => '##VALUE##InputHelperTest.php'
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

            'validationHelper'      => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ValidationHelper.txt'),
                'path'                  => app_path('Services/Validation'),
                'name'                  => '##VALUE##ValidationHelper.php'
            ),

            'presenter'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/Presenter.txt'),
                'path'                  => app_path('Presenters'),
                'name'                  => '##VALUE##Presenter.php'
            ),


            //- FormRequests ---

            'createFormRequest'     => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/CreateFormRequest.txt'),
                'path'                  => app_path('Http/Requests') .'##ADMIN_CLASS_PATH##/##CLASS_PLURAL##/',
                'name'                  => 'Create##VALUE##FormRequest.php'
            ),

            'updateFormRequest'     => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/UpdateFormRequest.txt'),
                'path'                  => app_path('Http/Requests') .'##ADMIN_CLASS_PATH##/##CLASS_PLURAL##/',
                'name'                  => 'Update##VALUE##FormRequest.php'
            ),

            'filterFormRequest'     => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FilterFormRequest.txt'),
                'path'                  => app_path('Http/Requests') .'##ADMIN_CLASS_PATH##/##CLASS_PLURAL##/',
                'name'                  => 'Filter##VALUE##FormRequest.php'
            ),


            //- views ---

            'indexView'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/IndexView.txt'),
                'path'                  => app_path('../resources/views') .'/bootstrap##ADMIN_RESOURCE_FOLDER_PATH##/##VARIABLE_PLURAL##/',
                'name'                  => 'index.blade.php'
            ),

            'listView'              => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ListView.txt'),
                'path'                  => app_path('../resources/views') .'/bootstrap##ADMIN_RESOURCE_FOLDER_PATH##/##VARIABLE_PLURAL##/',
                'name'                  => 'list.blade.php'
            ),

            'tableView'             => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/TableView.txt'),
                'path'                  => app_path('../resources/views') .'/bootstrap##ADMIN_RESOURCE_FOLDER_PATH##/##VARIABLE_PLURAL##/',
                'name'                  => 'table.blade.php'
            ),

            'showView'              => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/ShowView.txt'),
                'path'                  => app_path('../resources/views') .'/bootstrap##ADMIN_RESOURCE_FOLDER_PATH##/##VARIABLE_PLURAL##/',
                'name'                  => 'show.blade.php'
            ),

            'createView'            => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/CreateView.txt'),
                'path'                  => app_path('../resources/views') .'/bootstrap##ADMIN_RESOURCE_FOLDER_PATH##/##VARIABLE_PLURAL##/',
                'name'                  => 'create.blade.php'
            ),

            'editView'              => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/EditView.txt'),
                'path'                  => app_path('../resources/views') .'/bootstrap##ADMIN_RESOURCE_FOLDER_PATH##/##VARIABLE_PLURAL##/',
                'name'                  => 'edit.blade.php'
            ),

            'formView'              => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FormView.txt'),
                'path'                  => app_path('../resources/views') .'/bootstrap##ADMIN_RESOURCE_FOLDER_PATH##/##VARIABLE_PLURAL##/',
                'name'                  => 'form.blade.php'
            ),

            'filterView'            => array(
                'template'              => base_path('vendor/ixudra/generators/src/resources/templates/FilterView.txt'),
                'path'                  => app_path('../resources/views') .'/bootstrap##ADMIN_RESOURCE_FOLDER_PATH##/##VARIABLE_PLURAL##/',
                'name'                  => 'filter.blade.php'
            ),

        )

    );