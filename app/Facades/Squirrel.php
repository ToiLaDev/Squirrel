<?php


namespace App\Facades;

/**
 * @method static object getAdminMenu()
 * @method static mixed routes()
 *
 * @see \App\Services\Squirrel
 */

use Illuminate\Support\Facades\Facade;
use Laravel\Ui\UiServiceProvider;
use RuntimeException;

class Squirrel extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'squirrel';
    }

    /**
     * Register the typical authentication routes for an application.
     *
     * @param  array  $options
     * @return void
     *
     * @throws \RuntimeException
     */
    public static function routes()
    {
        if (! static::$app->providerIsLoaded(UiServiceProvider::class)) {
            throw new RuntimeException('In order to use the Auth::routes() method, please install the laravel/ui package.');
        }

        static::$app->make('router')->squirrel();
    }
}
