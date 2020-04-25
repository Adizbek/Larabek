<?php


namespace Adizbek\Larabek\Core;


trait FieldSortable
{
    protected $sortable = false;
    protected $sortDirection = null;
    protected $sortDefaultDir = null;


    /**
     * @param string $defaultDir
     * @return Field
     */
    public function sortable(string $defaultDir = null): self
    {
        $this->sortable = true;
        $this->sortDefaultDir = $defaultDir;

        $this->extra['sortable'] = $this->sortableData();

        return $this;
    }

    private function sortableData()
    {
        if ($this->sortable) {
            return [
                'direction' => $this->sortDirection,
                'default' => $this->sortDefaultDir
            ];
        }

        return null;
    }

    public function setSortDirection(string $direction)
    {
        $this->sortDirection = $direction;
    }

    public function setDefaultDirectionActive()
    {
        $this->sortDirection = $this->sortDefaultDir;
    }

    /**
     * @return string
     */
    public function getSortDirection()
    {
        return $this->sortDirection;
    }

    /**
     * @return bool
     */
    public function isSortable(): bool
    {
        return $this->sortable;
    }

    public function applySort($entity, $dir, $query)
    {
        if ($dir != null)
            $query->orderBy($this->getName(), $dir);
    }
}
