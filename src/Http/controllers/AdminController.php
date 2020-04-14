<?php

namespace Adizbek\Larabek\Controllers;


use Adizbek\Larabek\Larabek;
use Adizbek\Larabek\Entity;
use Illuminate\Http\Request;

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

        return response()->json($entity->getListMeta());
    }

    public function action(Request $request, $slug)
    {
        $action = $request->post('action');
        $data = $request->post('data');

        /**
         * @var $entity Entity
         */
        $entity = Larabek::getEntity($slug);

        $response = $entity->triggerAction($action);

        return response()->json($response);
    }
}
