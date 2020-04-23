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
        foreach ($this->getFilters() as $filter) {
            $filter->apply($this->request, $query, null);
        }

        return $query;
    }
}
