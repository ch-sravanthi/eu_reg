<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade as BaseFacade;

class EasyFormFacade extends BaseFacade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'easyform'; }
}
