<?php


namespace Adizbek\Larabek\Core\Actions;


use Adizbek\Larabek\Core\Action;

class EditAction extends Action
{

    public $text = 'edit';

    public function actionName()
    {
        return 'edit-action';
    }

    public function handle($entity, $fields, $models)
    {
        // TODO: Implement handle() method.
    }
}
