<?php


namespace Adizbek\Larabek;


use Illuminate\Database\Eloquent\Model;

class SwitchField extends Field
{

    public function type(): string
    {
        return 'switch';
    }

    public function transform(Model $model)
    {
        return [
            'checked' => boolval($model[$this->name])
        ];
    }
}
