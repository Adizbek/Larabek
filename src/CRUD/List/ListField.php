<?php


namespace Adizbek\GiveMeCrud;


use Illuminate\Database\Eloquent\Model;

abstract class ListField implements \JsonSerializable
{
    protected $name;

    /**
     * ListField constructor.
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

    public abstract function type(): string ;

    public abstract function transform(Model $model);

    public function getData(Model $model)
    {
        return [
            'type' => $this->type(),
            'name' => $this->getName(),
            'data' => $this->transform($model)
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
