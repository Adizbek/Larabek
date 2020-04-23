<?php


namespace Adizbek\Larabek\Core\Entity;


use Adizbek\Larabek\Core\Field;
use Illuminate\Support\Collection;

trait EntityForm
{
    public function getFormFields(): Collection
    {
        return $this->getFieldsCollection()->filter(function (Field $field) {
            return $field->isOnForm();
        });
    }

    public function getFormMeta($id): array
    {
        $model = $id ? $this->getModel()::find($id): null;

        $fields = $this->getFormFields()->map(function (Field $field) use ($model) {
            return $field->getFormData($model);
        });

        return [
            'model' => $model,
            'fields' => $fields,
        ];
    }
}
