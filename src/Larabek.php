<?php

namespace Adizbek\Larabek;

use Adizbek\Larabek\Core\Entity\Entity;
use Illuminate\Support\Facades\Facade;

/**
 * Class Larabek
 * @package Adizbek\Larabek
 * @method static Entity getEntity($entity);
 * @method static Entity getEntityByClass($entity);
 * @method static Entity[] getEntities();
 */
class Larabek extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'larabek';
    }
}
