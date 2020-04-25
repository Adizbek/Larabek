<?php


namespace Adizbek\Larabek\Core\Entity;

use Adizbek\Larabek\Core\Field;
use Adizbek\Larabek\Core\Filters\PaginationFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

abstract class Entity
{
    use EntitySheet, EntityDetails, EntityForm, EntityFilters, EntityActions;

    private $request;
    protected $pagination = null;

    protected $with = [];

    /**
     * Entity constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->pagination = new PaginationFilter();
    }

    /**
     * @return \Eloquent
     */
    public abstract function getModel();

    /**
     * @return string
     */
    public abstract function displayName();

    /**
     * @return Field[]
     */
    public abstract function getFields(): array;

    public function getFieldsCollection(): Collection
    {
        return Collection::make($this->getFields());
    }

    /**
     * @return string
     */
    public function name()
    {
        return strtolower(class_basename($this->getModel()));
    }

    public function update($id, array $data)
    {
        $model = $this->getModel()::find($id);
        $this->fill($model, $data);
        $model->save();

        return $model;
    }

    public function insert(array $data)
    {
        $cls = $this->getModel();
        $model = new $cls;

        $this->fill($model, $data);
        $model->save();

        return $model;
    }

    /**
     * @param \Model $model
     * @param $data
     */
    public function fill($model, $data)
    {
        $dataList = collect($data);
        $request = request();

        $this->getFormFields()->each(function (Field $field) use ($model, $dataList, $request) {
            $fieldName = $field->getName();
            $fieldData = $dataList->firstWhere('name', '=', $fieldName);

            if (!$fieldName)
                return;

            $field->fillModel($model, $request, $fieldName, $fieldData['data']);
        });
    }
}
