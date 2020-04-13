<?php


namespace Adizbek\GiveMeCrud;


use Illuminate\Database\Eloquent\Model;

class SwitchField extends ListField
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
