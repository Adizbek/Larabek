<?php


namespace Adizbek\Larabek\Core\Entity;


use Adizbek\Larabek\Core\Field;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

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
     * @return array
     */
    public function getList()
    {
        $query = $this->applyFilters($this->getListQuery());

        /** @var LengthAwarePaginator $pagination */
        $pagination = $query->paginate($this->pagination->selected);

        $pagination->getCollection()->transform(function ($model) {
            return [
                'fields' => $this->getSheetFields()->map(function (Field $field) use ($model) {
                    return $field->getData($model);
                }),

                'model' => $model
            ];
        });

        return $pagination->toArray();
    }


    public function getListMeta()
    {
        return [
            'list' => $this->getList(),
            'fields' => $this->getSheetFields(),
            'filters' => $this->getFilters(),
            'actions' => $this->getActions()
        ];
    }
}
