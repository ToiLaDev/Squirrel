<?php


namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Widget
 * @package App
 * @method static register($widget, $action = null)
 * @method static display($name, $data = null)
 * @method static boolean has($name)
 */

class Widget extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'widget';
    }
}
