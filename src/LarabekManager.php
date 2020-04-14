<?php


namespace Adizbek\Larabek;


use App\Post;
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

        $this->entities[$instance->slug()] = $instance;
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
                'name' => $e->name(),
                'slug' => $e->slug()
            ];
        })->toArray();
    }

    public function getEntity($slug)
    {
        return $this->entities[$slug];
    }


}
