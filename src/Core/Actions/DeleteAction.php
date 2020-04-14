<?php

namespace Adizbek\Larabek\Core\Actions;

use Adizbek\Larabek\Core\Action;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DeleteAction extends Action
{

    public $text = 'delete';

    public function actionName()
    {
        return 'delete-action';
    }

    public function handle($entity, $fields, $models)
    {
        $keys = $models->modelKeys();
        $deleted = $entity->getModel()::whereIn('id', $keys)->delete();

        return ['deleted' => $deleted];
    }
}
