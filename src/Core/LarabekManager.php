<?php


namespace Adizbek\Larabek\Core;


use Adizbek\Larabek\Core\Entity\Entity;
use Illuminate\Support\Collection;

class LarabekManager
{
    /**
     * @var Entity[]
     */
    private $entities = [];

    public function register($class)
    {
        /**
         * @var $instance Entity
         */
        $instance = new $class(request());

        $this->entities[$instance->name()] = $instance;
    }

    /**
     * @return array
     */
    public function getEntities(): array
    {
        return Collection::make($this->entities)->map(function ($e) {
            /**
             * @var $e Entity
             */

            return [
                'displayName' => $e->displayName(),
                'name' => $e->name()
            ];
        })->toArray();
    }

    public function getEntity($name)
    {
        return $this->entities[$name];
    }

    public function getEntityByClass($class)
    {
        foreach ($this->entities as $entity) {
            if(get_class($entity) === $class) {
                return $entity;
            }
        }

        return null;
    }


}
