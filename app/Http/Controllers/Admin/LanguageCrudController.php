<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LanguageRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LanguageCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LanguageCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;   

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Language::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/language');
        CRUD::setEntityNameStrings('language', 'languages');
        $this->crud->orderBy('lft', 'asc');             
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(LanguageRequest::class);

        CRUD::AddFields(
            [
                [
                    'name'    => 'is_active',
                    'label'   => 'Status',
                    'type'    => 'radio',
                    'options' => [
                                    0 => "Disable",
                                    1 => "Active"
                    ],
                    'default' => 1
                ],
                [
                    'label' => 'Name',
                    'type'  => 'text',
                    'name'  => 'name'
                ],
                [
                    'label' => 'Slug',
                    'type'  => 'text',
                    'name'  => 'slug'
                ],                
                [
                   'label'     => "Abbreviation",
                   'type'      => "text",
                   'name'      => 'abbrev',
                   'hint'  => '2 characters'
                ],
            ]
        );

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    /**
     * Define reorder operation.
     * 
     * @see https://backpackforlaravel.com/docs/4.1/crud-operation-reorder
     * @return void
     */
    protected function setupReorderOperation()
    {
        // define which model attribute will be shown on draggable elements 
        $this->crud->set('reorder.label', 'name');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 2);
    }  
}
