<?php

namespace Adizbek\Larabek\Controllers;


use Adizbek\Larabek\Larabek;
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

    public function list($entity)
    {
        return response()->json(Larabek::getEntity($entity)->getListMeta());
    }

    public function details($entity, $id)
    {
        return response()->json(Larabek::getEntity($entity)->getDetailsMeta($id));
    }

    public function action($entity, $action)
    {
        return response()->json(Larabek::getEntity($entity)->triggerAction($action));
    }
}
