<?php


namespace Adizbek\Larabek\Core\Actions;


use Adizbek\Larabek\Core\Action;

class DetailsAction extends Action
{

    public $text = 'details';

    public $icon = ['far', 'eye'];

    public $batch = false;

    public function actionName()
    {
        return 'details-action';
    }

    public function handle($entity, $fields, $models)
    {
        // TODO: Implement handle() method.
    }
}
