<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TweetRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TweetCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class TweetCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Tweet::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/tweet');
        CRUD::setEntityNameStrings('tweet', 'tweets');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        CRUD::addColumn([
            'name' => 'user',
            'type' => 'relationship',
            'label' => 'Author',
        ]);

        CRUD::column('image');
        CRUD::column('body');
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->setupListOperation();
        CRUD::column('body');
        CRUD::column('image');
        CRUD::column('created_at');
        CRUD::column('updated_at');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TweetRequest::class);

        CRUD::addField([
            'name' => 'user_id',
            'label' => "Author",
            'type' => 'select2',
            'entity' => 'user',
            'model' => "App\Models\User", // related model
            'attribute' => 'name',
        ]);

        CRUD::addField([   // Upload
            'name' => 'image',
            'label' => 'Image',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public', // if you store files in the /public folder, please ommit this; if you store them in /storage or S3, please specify it;
        ]);

        CRUD::field('body');

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
