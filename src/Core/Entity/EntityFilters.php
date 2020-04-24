<?php


namespace Adizbek\Larabek\Core\Entity;


use Adizbek\Larabek\Core\Filter;
use Adizbek\Larabek\Core\Filters\PaginationFilter;
use Illuminate\Database\Eloquent\Builder;

trait EntityFilters
{
    /**
     * @return Filter[]
     */
    public function getFilters()
    {
        return $this->getDefaultFilters() + $this->filters();
    }

    public function fillFilters()
    {
        $appliedFilters = json_decode(base64_decode(request()->query('filters')));
        $filters = $this->getFilters();

        foreach ($filters as $filter) {
            $value = $appliedFilters->{$filter->getKey()};

            if (isset($value)) {
                $filter->setValue($value);
            }
        }

        return $filters;
    }

    public function getDefaultFilters()
    {
        return [
            $this->pagination
        ];
    }

    public function filters()
    {
        return [];
    }


    private function applyFilters(Builder $query): Builder
    {
        foreach ($this->getFilters() as $filter) {
            $filter->apply($this->request, $query, $filter->value);
        }

        return $query;
    }
}
