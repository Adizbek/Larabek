<?php


namespace Adizbek\GiveMeCrud;


use Illuminate\Database\Eloquent\Model;

class TextField extends ListField
{

    public function type(): string
    {
        return 'text';
    }

    public function transform(Model $model)
    {
        return [
            'text' => $model[$this->name]
        ];
    }
}
