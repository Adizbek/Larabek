<?php


namespace Adizbek\Larabek\Core\Entity;


use Adizbek\Larabek\Core\Field;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait EntitySheet
{
    public function getListQuery(): Builder
    {
        return $this->getModel()::query();
    }

    public function getSheetFields(): \Illuminate\Support\Collection
    {
        return $this->getFieldsCollection()->filter(function (Field $field) {
            return $field->isOnSheet();
        });
    }

    /**
     * @return Collection|Model[]
     */
    public function getList()
    {
        $query = $this->applyFilters($this->getListQuery());

        return $query->get()->map(function ($model) {
            return [
                'fields' => $this->getSheetFields()->map(function (Field $field) use ($model) {
                    return $field->getData($model);
                }),

                'model' => $model
            ];
        });
    }


    public function getListMeta()
    {
        return [
            'items' => $this->getList(),
            'fields' => $this->getFields(),
            'actions' => $this->getActions()
        ];
    }
}
