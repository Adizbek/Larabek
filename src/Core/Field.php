<?php


namespace Adizbek\Larabek\Core;


use Illuminate\Database\Eloquent\Model;

abstract class Field implements \JsonSerializable
{
    use Hideable;

    protected $name;
    protected $label;

    protected $extra = [];

    /**
     * Field constructor.
     * @param $name
     * @param string $label
     */
    public function __construct($name, $label = '')
    {
        $this->name = $name;
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public static function make(...$args): self
    {
        $class = get_called_class();
        return new $class(...$args);
    }

    public abstract function type(): string;

    public abstract function transform(Model $model, bool $form);

    public function getData(Model $model)
    {
        return [
            'type' => $this->type(),
            'name' => $this->getName(),
            'data' => $this->transform($model, false)
        ];
    }

    /**
     * @param Model|null $model
     * @return array
     */
    public function getFormData(?Model $model)
    {
        return [
            'type' => $this->type(),
            'name' => $this->getName(),
            'data' => $model ? $this->transform($model, true) : json_decode('{}')
        ];
    }


    public function jsonSerialize()
    {
        return $this->extra +
            [
                'name' => $this->name,
                'label' => $this->label,
                'type' => $this->type(),
            ];
    }

    /**
     * @param Model $model
     * @param \Illuminate\Http\Request $request
     * @param string $fieldName
     * @param $fieldData
     */
    public function fillModel($model, $request, string $fieldName, $fieldData)
    {
        $model->setAttribute($fieldName, $fieldData);
    }


}
