<?php


namespace Adizbek\Larabek\Core\Fields;


use Adizbek\Larabek\Core\Entity\Entity;
use Adizbek\Larabek\Core\Field;
use Adizbek\Larabek\Larabek;
use Illuminate\Database\Eloquent\Model;

class BelongsTo extends Field
{

    /** @var Entity */
    private $entity;

    private $relationship;


    /**
     * @var string|callable
     */
    private $displayBy = null;

    /**
     * BelongsTo constructor.
     * @param $label
     * @param $relationship
     * @param $entity
     */
    public function __construct($label, $relationship, $entity)
    {
        parent::__construct($relationship, $label);


        $this->entity = Larabek::getEntityByClass($entity);
        $this->relationship = $relationship;
    }

    public function type(): string
    {
        return 'belongs-to';
    }

    public function transform(Model $model, bool $form)
    {
        $relation = $model->{$this->relationship}();
        $relation = $relation->first();

        if ($relation) {
            return $this->extractData($relation);
        }

        return null;
    }

    public function getData(Model $model)
    {
        return parent::getData($model) + ['entity' => $this->entity->name()];
    }

    public function getFormData(?Model $model)
    {
        return
            parent::getFormData($model) +
            [
                'items' => $this->entity->getModel()::all()->map(function ($model) {
                    return $this->extractData($model);
                }),
                'entity' => $this->entity->name()
            ];
    }

    public function displayBy($displayBy)
    {
        $this->displayBy = $displayBy;

        return $this;
    }

    public function extractData($model)
    {
        return [
            'id' => $model->getKey(),
            'text' => $this->display($model)
        ];
    }

    public function display($model)
    {
        if (is_string($this->displayBy)) {
            return $model[$this->displayBy];
        } else if (is_callable($this->displayBy)) {
            return call_user_func($this->displayBy, $model);
        }

        return $model->getKey();

    }

    public function fillModel($model, $request, string $fieldName, $fieldData)
    {
        /** @var \Illuminate\Database\Eloquent\Relations\BelongsTo $key */
        $key = $model->{$this->relationship}();

        $model->setAttribute($key->getForeignKeyName(), $fieldData['id']);
    }
}
