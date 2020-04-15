<?php


namespace Adizbek\Larabek\Core\Entity;


use Adizbek\Larabek\Core\Action;
use Adizbek\Larabek\Core\Actions\DeleteAction;
use Adizbek\Larabek\Core\Actions\DetailsAction;
use Adizbek\Larabek\Core\Actions\EditAction;
use Illuminate\Database\Eloquent\Collection;

trait EntityActions
{

    public function getActions()
    {
        return $this->defaultActions() + $this->actions();
    }

    public function defaultActions(): array
    {
        return [
            new DetailsAction(),
            new EditAction(),
            new DeleteAction()
        ];
    }

    public function actions(): array
    {
        return [];
    }

    public function triggerAction($actionName)
    {
        /**
         * @var $models Collection
         */
        $models = $this->getModel()::whereIn('id', $this->request->post('models'))->get();

        if (!$models->count()) {
            return null;
        }

        foreach ($this->getActions() as $action) {
            /**
             * @var $action Action
             */

            if ($action->actionName() === $actionName) {
                return $action->handle($this, null, $models);
            }
        }

        return null;
    }
}
