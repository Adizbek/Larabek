<?php


namespace Adizbek\Larabek;

use Adizbek\Larabek\Core\Action;
use Adizbek\Larabek\Core\Actions\DeleteAction;
use Adizbek\Larabek\Core\Actions\DetailsAction;
use Adizbek\Larabek\Core\Actions\EditAction;
use Adizbek\Larabek\Core\Filter;
use Adizbek\Larabek\Core\Filters\PaginationFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class Entity
{

    private $request;

    /**
     * Entity constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Model
     */
    public abstract function getModel();

    /**
     * @return string
     */
    public abstract function name();

    /**
     * @return string
     */
    public function slug()
    {
        return strtolower(class_basename($this->getModel()));
    }

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

    /**
     * @return Filter[]
     */
    public function getFilters()
    {
        return $this->getDefaultFilters() + $this->filters();
    }

    public function getDefaultFilters()
    {
        return [
            new PaginationFilter()
        ];
    }

    public function filters()
    {
        return [];
    }


    private function applyFilters(Builder $query)
    {
        foreach ($this->getFilters() as $filter) {
            $filter->apply($this->request, $query, null);
        }
    }

    public function getListQuery(): Builder
    {
        return $this->getModel()::query();
    }


    /**
     * @return Collection|Model[]
     */
    public function getList()
    {
        $query = $this->getListQuery();

        $this->applyFilters($query);

        return $query->get()->map(function ($model) {
            return [
                'fields' => Collection::make($this->getListFields())->map(function ($field) use ($model) {
                    /** @var $field Field */

                    return $field->getData($model);
                }),

                'model' => $model
            ];
        });
    }

    /**
     * @return Field[]
     */
    public abstract function getListFields(): array;

    public function getListMeta()
    {
        return [
            'items' => $this->getList(),
            'fields' => $this->getListFields(),
            'actions' => $this->getActions()
        ];
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
