<?php

namespace Hymns\ToyyibPay;

use Illuminate\Support\Facades\Facade;

class ToyyibPayFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ToyyibPay';
    }
}
