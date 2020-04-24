<?php


namespace Adizbek\Larabek\Core;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Filter implements \JsonSerializable
{

    public $title = 'A Filter';

    public $name = 'filter';

    public $data = [];

    public $applyOnlyPresent = true;

    public $value = null;
    public $defaultValue = null;

    public abstract function apply(Request $request, Builder $builder, $value);

    public function jsonSerialize()
    {
        return [
            'title' => $this->title,
            'key' => $this->getKey(),
            'name' => $this->name,
            'data' => $this->data,
            'value' => $this->value,
            'defaultValue' => $this->defaultValue
        ];
    }

    public function getKey()
    {
        return get_class($this);
    }

    public function setValue($value)
    {
        $this->value = $value;
    }
}

