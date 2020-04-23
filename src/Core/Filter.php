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

    public abstract function apply(Request $request, Builder $builder, $value);

    public function jsonSerialize()
    {
        return [
            'title' => $this->title,
            'key' => $this->getKey(),
            'name' => $this->name,
            'data' => $this->data
        ];
    }

    public function getKey()
    {
        return get_class($this);
    }
}

