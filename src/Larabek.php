<?php

namespace Adizbek\Larabek;

use Illuminate\Support\Facades\Facade;

class Larabek extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'larabek';
    }
}
