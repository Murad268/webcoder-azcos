<?php

namespace App\Facades;

use App\Models\Menu;
use Illuminate\Support\Facades\Facade;

class MenuListUtility extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'menulistutility';
    }
}
