<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RetweetRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RetweetCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RetweetCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Retweet::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/retweet');
        CRUD::setEntityNameStrings('retweet', 'retweets');
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

        CRUD::addColumn([
            'name' => 'tweet',
            'type' => 'relationship',
            'label' => 'Tweet',
        ]);
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        $this->setupListOperation();
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
        CRUD::setValidation(RetweetRequest::class);

        CRUD::addField([
            'name' => 'user_id',
            'label' => "Author",
            'type' => 'select2',
            'entity' => 'user',
            'model' => "App\Models\User", // related model
            'attribute' => 'name',
        ]);

        CRUD::addField([
            'name' => 'tweet_id',
            'label' => "Tweet",
            'type' => 'select2',
            'entity' => 'tweet',
            'model' => "App\Models\Tweet", // related model
            'attribute' => 'body',
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
