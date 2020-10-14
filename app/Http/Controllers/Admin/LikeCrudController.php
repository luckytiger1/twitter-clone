<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LikeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LikeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class LikeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Like::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/like');
        CRUD::setEntityNameStrings('like', 'likes');
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

        CRUD::addColumn([
            'name' => 'liked',
            'label' => 'Liked',
            'type' => 'boolean',
            // optionally override the Yes/No texts
            // 'options' => [0 => 'Active', 1 => 'Inactive']
        ]);

    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(LikeRequest::class);


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


        CRUD::field('liked');

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
