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
        $appliedFilters = json_decode(base64_decode(request()->query('filters')));

        foreach ($this->getFilters() as $filter) {
            $value = $appliedFilters ? $appliedFilters->{$filter->getKey()} : null;

            $filter->setValueAndApply($this->request, $query, $value);
        }

        return $query;
    }
}
