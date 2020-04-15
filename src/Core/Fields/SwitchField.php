<?php


namespace Adizbek\Larabek\Core\Fields;

use Adizbek\Larabek\Core\Field;
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
