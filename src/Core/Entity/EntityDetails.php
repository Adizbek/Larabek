<?php


namespace Adizbek\Larabek\Core\Entity;


use Adizbek\Larabek\Core\Field;
use Illuminate\Support\Collection;

trait EntityDetails
{
    public function getDetailsFields(): Collection
    {
        return $this->getFieldsCollection()->filter(function (Field $field) {
            return $field->isOnDetails();
        });
    }

    public function getDetailsMeta($id): array
    {
        $model = $this->getModel()::find($id);

        $fields = $this->getDetailsFields()->map(function (Field $field) use ($model) {
            return $field->getData($model);
        });

        return [
            'model' => $model,
            'fields' => $fields,
            'actions' => $this->getActions()
        ];
    }
}
