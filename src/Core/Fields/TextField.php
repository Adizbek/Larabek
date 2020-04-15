<?php


namespace Adizbek\Larabek\Core\Fields;


use Adizbek\Larabek\Core\Field;
use Illuminate\Database\Eloquent\Model;

class TextField extends Field
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
