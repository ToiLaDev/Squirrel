<?php


namespace App\Facades;

/**
 *
 * @see \App\Services\Asset
 */

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * Class Asset
 * @package App
 * @method static addScript($stack, $scripts)
 * @method static addStyle($stack, $styles)
 * @method static Collection getScripts($stack)
 * @method static Collection getStyles($stack)
 */

class Asset extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'asset';
    }
}
