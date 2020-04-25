<?php


namespace Adizbek\Larabek\Core\Fields;


use Adizbek\Larabek\Core\SortableField;
use Illuminate\Database\Eloquent\Model;

class TextField extends SortableField
{
    public function type(): string
    {
        return 'text';
    }

    public function transform(Model $model, bool $form)
    {
        return [
            'text' => $model[$this->name]
        ];
    }

    public function fillModel($model, $request, string $fieldName, $fieldData)
    {
        $model->setAttribute($fieldName, $fieldData['text']);
    }


}
