<?php

namespace Adizbek\GiveMeCrud\Controllers;


use Adizbek\GiveMeCrud\CRUD;
use Adizbek\GiveMeCrud\Entity;

class AdminController
{
    public function index()
    {
        return view('admin::layout.index');
    }

    public function entities()
    {
        $entities = CRUD::getEntities();

        return response()->json($entities);
    }

    public function list($slug)
    {
        /**
         * @var $entity Entity
         */
        $entity = CRUD::getEntity($slug);

        return response()->json([
            'items' => $entity->getList(),
            'fields' => $entity->getListFields()
        ]);
    }
}
