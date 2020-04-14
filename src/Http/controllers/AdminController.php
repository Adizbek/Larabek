<?php

namespace Adizbek\Larabek\Controllers;


use Adizbek\Larabek\Larabek;
use Adizbek\Larabek\Entity;

class AdminController
{
    public function index()
    {
        return view('admin::layout.index');
    }

    public function entities()
    {
        $entities = Larabek::getEntities();

        return response()->json($entities);
    }

    public function list($slug)
    {
        /**
         * @var $entity Entity
         */
        $entity = Larabek::getEntity($slug);

        return response()->json([
            'items' => $entity->getList(),
            'fields' => $entity->getListFields()
        ]);
    }
}
