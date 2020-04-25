<?php


namespace Adizbek\Larabek\Core\Entity;


use Adizbek\Larabek\Core\Field;
use Adizbek\Larabek\Core\SortableField;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

trait EntitySheet
{
    public function getListQuery(): Builder
    {
        return $this->getModel()::query()->with($this->with);
    }

    public function getSheetFields(): Collection
    {
        return $this->getFieldsCollection()->filter(function (Field $field) {
            return $field->isOnSheet();
        });
    }

    /**
     * @param Collection $fields
     * @return array
     */
    public function getList(Collection $fields)
    {
        $query = $this->applyFilters($this->getListQuery());
        $query = $this->applySorts($fields, $query);

        /** @var LengthAwarePaginator $pagination */
        $pagination = $query->paginate($this->pagination->getSelectedValue());

        $pagination->getCollection()->transform(function ($model) use ($fields) {
            return [
                'fields' => $fields->map(function (Field $field) use ($model) {
                    return $field->getData($model);
                }),

                'model' => $model
            ];
        });

        return $pagination->toArray();
    }


    public function getListMeta()
    {
        $fields = $this->getSheetFields();
        $this->fillSorts($fields);

        // fill filters with values from request and get them
        $filters = $this->fillFilters();

        return [
            'list' => $this->getList($fields),
            'fields' => $fields,
            'filters' => $filters,
            'actions' => $this->getActions()
        ];
    }

    protected function fillSorts(Collection $fields)
    {
        $appliedSorts = json_decode(base64_decode(request()->query('sorts')));

        if ($appliedSorts)
            $fields->each(function (Field $field) use ($appliedSorts) {
                if ($field instanceof SortableField) {
                    $sort = @$appliedSorts->{$field->getName()};

                    // if sorted use value otherwise use default direction
                    if (isset($sort)) {
                        $field->setSortDirection($sort);
                    } else {
                        $field->setDefaultDirectionActive();
                    }
                }
            });

    }

    /**
     * @param Collection $fields
     * @param Builder $query
     * @return Builder
     */
    protected function applySorts(Collection $fields, Builder $query)
    {
        // TODO how to apply two orders ?
        $fields
            ->filter(function (Field $field) {
                return $field instanceof SortableField;
            })
            ->each(function (SortableField $field) use ($query) {
                $field->applySort($this, $field->getSortDirection(), $query);
            });

        return $query;
    }
}
