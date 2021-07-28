<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CommentRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CommentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CommentCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Comment::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/comment');
        CRUD::setEntityNameStrings('comment', 'comments');
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
        CRUD::setValidation(CommentRequest::class);

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
                    'label' => 'Comment',
                    'type'  => 'ckeditor',
                    'rows'  => 10,
                    'name'  => 'comment',
                    'min'   => 10,
                    'max'   => 1024,
                    'hint'  => 'Minimum of 10 characters - Maximum of 1024 characters'
                ],                                               
                [
                    'label'     => "User",
                    'type'      => 'select2',
                    'name'      => 'user_id',
                    'entity'    => 'user',
                    'attribute' => 'name',
                    'model'     => "App\Models\User",
                    'options'   => (function ($query) {
                        return $query->orderBy('name', 'ASC')->get();
                    }),
                ], 
                
                [
                    'label'     => "Site",
                    'type'      => 'select2',
                    'name'      => 'site_id',
                    'entity'    => 'site',
                    'attribute' => 'name',
                    'model'     => "App\Models\Site",
                    'options'   => (function ($query) {
                        return $query->orderBy('name', 'ASC')->get();
                    }),
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
}
