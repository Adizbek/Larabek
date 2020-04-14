<?php


namespace Adizbek\Larabek;

use App\Entities\UserEntity;
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


    /**
     * @return Collection|Model[]
     */
    public function getList()
    {
        return $this->getModel()::all()->map(function ($model) {
            return Collection::make($this->getListFields())->map(function ($field) use ($model) {
                /** @var $field ListField */

                return $field->getData($model);
            });
        });
    }

    /**
     * @return ListField[]
     */
    public abstract function getListFields(): array;

}
