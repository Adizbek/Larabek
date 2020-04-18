<?php


namespace Adizbek\Larabek\Core;


use Illuminate\Database\Eloquent\Model;

abstract class Field implements \JsonSerializable
{
    use Hideable;

    protected $name;

    /**
     * Field constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public abstract function type(): string;

    public abstract function transform(Model $model);

    public function getData(Model $model)
    {
        return [
            'type' => $this->type(),
            'name' => $this->getName(),
            'data' => $this->transform($model)
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
            'data' => $model ? $this->transform($model) : null
        ];
    }


    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'type' => $this->type()
        ];
    }


}
