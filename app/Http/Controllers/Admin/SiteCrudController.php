<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SiteRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SiteCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SiteCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Site::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/site');
        CRUD::setEntityNameStrings('site', 'sites');
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
        CRUD::addColumns(
            [
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
                    'label' => 'Description',
                    'type'  => 'text',
                    'name'  => 'description'
                ],
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
                    'name'    => 'is_dofollow',
                    'label'   => 'Status',
                    'type'    => 'radio',
                    'options' => [
                                    0 => "Dofollow",
                                    1 => "Nofollow"
                                ],
                    'default' => 1
                ],
                [
                    'name'    => 'is_free',
                    'label'   => 'Status',
                    'type'    => 'radio',
                    'options' => [
                                    0 => "Free",
                                    1 => "Paid"
                                ],
                    'default' => 1
                ],
                [
                    'label'     => "Category",
                    'type'      => "select",
                    'name'      => 'category_id',
                    'entity'    => 'category',
                    'attribute' => "name",
                    'model'     => "App\Models\Category",
                ],
                [
                    'label'     => "Type",
                    'type'      => "select",
                    'name'      => 'website_type_id',
                    'entity'    => 'website_type',
                    'attribute' => "name",
                    'model'     => "App\Models\WebsiteType",
                ],
                [
                    'label'     => "Tags",
                    'type'      => "select_multiple",
                    'name'      => 'tags',
                    'entity'    => 'tags',
                    'attribute' => "name",
                    'model'     => "App\Models\Tag",
                 ],
            ]
        );

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
        CRUD::setValidation(SiteRequest::class);

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
                ],
                [
                    'name'    => 'is_dofollow',
                    'label'   => 'Status',
                    'type'    => 'radio',
                    'options' => [
                                    0 => "Dofollow",
                                    1 => "Nofollow"
                                ],
                ],
                [
                    'name'    => 'is_free',
                    'label'   => 'Directory Type',
                    'type'    => 'radio',
                    'options' => [
                                    0 => "Free",
                                    1 => "Paid"
                                ],
                ],
                [
                    'name'    => 'link_in_bio',
                    'label'   => 'Status',
                    'type'    => 'radio',
                    'options' => [
                                    0 => "Approve link in bio?",
                                    1 => "NO"
                                ],
                    'hint'  => 'If approve link in bio for forum, blogs'
                ],
                [
                    'name'    => 'link_in_comments',
                    'label'   => 'Status',
                    'type'    => 'radio',
                    'options' => [
                                    0 => "Allow link in comments?",
                                    1 => "NO"
                                ],
                    'hint'  => 'If allow link in comments for forum, blogs'
                ],
                [
                    'label'     => "Approve comments",
                    'type'      => 'select2',
                    'name'      => 'approve_id',
                    'entity'    => 'approve',
                    'attribute' => 'name',
                    'model'     => "App\Models\Approve",
                    'options'   => (function ($query) {
                        return $query->orderBy('name', 'ASC')->get();
                    }),
                ],
                [
                    'label' => 'Submit for approve comment/site',
                    'type'  => 'date',
                    'name'  => 'submitted_date',
                ],
                [
                    'label' => 'Approved date',
                    'type'  => 'date',
                    'name'  => 'approved_date',
                ],
                [
                    'label' => 'Name',
                    'type'  => 'text',
                    'name'  => 'name',
                    'min'   => 2,
                    'max'   => 255,
                    'hint'  => 'Minimum of 2 characters - Maximum of 255 characters'
                ],
                [
                    'label' => 'Website URL',
                    'type'  => 'url',
                    'name'  => 'url',
                    'min'   => 5,
                    'max'   => 255,
                    'hint'  => 'Minimum of 5 characters - Maximum of 255 characters'
                ],
                [
                    'label' => 'Description',
                    'type'  => 'ckeditor',
                    'rows'  => 10,
                    'name'  => 'description',
                    'min'   => 50,
                    'max'   => 1024,
                    'hint'  => 'Minimum of 50 characters - Maximum of 1024 characters'
                ],
                [
                    'label' => 'Meta title',
                    'type'  => 'text',
                    'name'  => 'meta_title',
                    'min'   => 2,
                    'max'   => 70,
                    'hint'  => 'Minimum of 2 characters - Maximum of 70 characters'
                ],
                [
                    'label' => 'Meta description',
                    'type'  => 'text',
                    'name'  => 'meta_description',
                    'min'   => 2,
                    'max'   => 160,
                    'hint'  => 'Minimum of 2 characters - Maximum of 160 characters'
                ],
                [
                    'label'        => "Cover",
                    'name'         => "cover",
                    'type'         => 'image',
                    'upload'       => true,
                    'hint'         => 'Respect 1:9 ratio (We highly recommend to upload a 300x25 image).',
                    'crop'         => true,
                    'aspect_ratio' => 0,
                ],
                [
                    'label' => 'MOZ SPAM',
                    'type'  => 'number',
                    'name'  => 'spam',
                ],
                [
                    'label' => 'MOZ PA',
                    'type'  => 'number',
                    'name'  => 'pa',
                ],
                [
                    'label' => 'MOZ DA',
                    'type'  => 'number',
                    'name'  => 'da',
                ],
                [
                    'label' => 'TOTAL LINKS',
                    'type'  => 'number',
                    'name'  => 'total_links',
                ],
                [
                    'label' => 'Sent contact to owner',
                    'type'  => 'date',
                    'name'  => 'contact_sent',
                ],
                [
                    'name' => 'price',
                    'label' => 'Price',
                    'type' => 'number',
                    'hint'  => 'Price to submit / advertorial',
                ],
                [
                    'label' => 'Response contact to owner',
                    'type'  => 'date',
                    'name'  => 'contact_response',
                ],
                [
                    'label' => 'Response from owner',
                    'type'  => 'ckeditor',
                    'name'  => 'about_response',
                    'min'   => 2,
                    'max'   => 255,
                    'hint'  => 'Minimum of 2 characters - Maximum of 255 characters'
                ],
                [
                    'label'        => "Analytics stats pic",
                    'name'         => "analytics",
                    'type'         => 'image',
                    'upload'       => true,
                    'hint'         => 'Respect 1:1 ratio (We highly recommend to upload a 300x25 image).',
                    'crop'         => true,
                    'aspect_ratio' => 1,
                ],
                [
                    'label'     => "Category",
                    'type'      => 'select2',
                    'name'      => 'category_id',
                    'entity'    => 'category',
                    'attribute' => 'name',
                    'model'     => "App\Models\Category",
                    'options'   => (function ($query) {
                        return $query->orderBy('name', 'ASC')->get();
                    }),
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
                    'label'     => "Website type",
                    'type'      => 'select2',
                    'name'      => 'website_type_id',
                    'entity'    => 'website_type',
                    'attribute' => 'name',
                    'model'     => "App\Models\WebsiteType",
                    'options'   => (function ($query) {
                        return $query->orderBy('name', 'ASC')->get();
                    }),
                ],
                [
                    'label'     => "Language",
                    'type'      => 'select2',
                    'name'      => 'language_id',
                    'entity'    => 'language',
                    'attribute' => 'abbrev',
                    'model'     => "App\Models\Language",
                    'options'   => (function ($query) {
                        return $query->orderBy('abbrev', 'ASC')->get();
                    }),
                ],
                [
                    'label'     => "Tags",
                    'type'      => 'select2_multiple',
                    'name'      => 'tags',
                    'entity'    => 'tags',
                    'attribute' => 'name',
                    'model'     => "App\Models\Tag",
                    'pivot'     => true,
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

    /*
    https://backpackforlaravel.com/docs/4.1/crud-operation-create#documentation-box
    public function store()
    {

        $this->crud->getRequest()->request->add(['user_id'=> backpack_user()->id]);
      // do something before validation, before save, before everything
      $response = $this->traitStore();
      // do something after save
      return $response;
    }*/


    protected function setupReorderOperation()
    {
        // define which model attribute will be shown on draggable elements
        $this->crud->set('reorder.label', 'name');
        // define how deep the admin is allowed to nest the items
        // for infinite levels, set it to 0
        $this->crud->set('reorder.max_level', 2);
    }
}
