<?php

namespace Adizbek\GiveMeCrud;

use Illuminate\Support\Facades\Facade;

class CRUD extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'crud';
    }
}
