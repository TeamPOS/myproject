<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use PhpParser\Node\Expr\FuncCall;

/**
 * Class TagCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TagCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Tag::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/tag');
        CRUD::setEntityNameStrings('tag', 'tags');
		
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
        CRUD::addColumn(['name' => 'name', 'type' => 'text']);
        CRUD::addColumn(['name' => 'image', 'type' => 'image']);
        CRUD::addColumn(['name' => 'for_sale', 'type' => 'check']);
        CRUD::addColumn(['name' => 'for_rent', 'type' => 'check']);
        CRUD::addColumn(['name' => 'is_appraisal', 'type' => 'check']);

        //CRUD::column('Image')->type('image');
        // $this->crud->addColumn([
        //     'name' => 'name', // The db column name
        //     'label' => 'Tag', // Table column heading

        //$this->crud->enableExportButtons();
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TagRequest::class);
		

        //CRUD::setFromDb(); // fields

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */

        $this->crud->addField([   // Text
            'name'  => 'name',
            'label' => "Tag Name",
            'type'  => 'text',

        ]);

        $this->crud->addField([   // Text
            'name'  => 'for_sale',
            'label' => 'Sale',
            'type'  => 'checkbox',
            'wrapper' => [
                'class' => 'form-group col-md-4',
            ],
        ]);
        $this->crud->addField([   // Text
            'name'  => 'for_rent',
            'label' => 'For Rent',
            'type'  => 'checkbox',
            'wrapper' => ['class' => 'form-group col-md-4'],

        ]);
        $this->crud->addField([   // Text
            'name'  => 'is_appraisal',
            'label' => 'For Appraisal',
            'type'  => 'checkbox',
            'wrapper' => [
                'class' => 'form-group col-md-4',
            ],

        ]);


        $this->crud->addField([ // image
            'label' => "Image",
            'name' => "image",
            'type' => 'image',
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            'prefix' => '' // in case you only store the filename in the database, this text will be prepended to the database value
        ]);
		
		
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
