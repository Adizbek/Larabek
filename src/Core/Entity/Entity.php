<?php


namespace Adizbek\Larabek\Core\Entity;

use Adizbek\Larabek\Core\Field;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

abstract class Entity
{
    use EntitySheet, EntityDetails, EntityForm, EntityFilters, EntityActions;

    private $request;

    /**
     * Entity constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Model
     */
    public abstract function getModel();

    /**
     * @return string
     */
    public abstract function displayName();

    /**
     * @return Field[]
     */
    public abstract function getFields(): array;

    public function getFieldsCollection(): Collection
    {
        return Collection::make($this->getFields());
    }

    /**
     * @return string
     */
    public function name()
    {
        return strtolower(class_basename($this->getModel()));
    }
}
