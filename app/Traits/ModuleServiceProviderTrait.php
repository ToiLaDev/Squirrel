<?php

namespace App\Traits;

use App\Facades\Squirrel;
use App\Facades\Widget;
use Illuminate\Contracts\Foundation\CachesConfiguration;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use ReflectionClass;

trait ModuleServiceProviderTrait {

    protected $path;
    protected $package;
    protected $namespace;
    protected $moduleName;

    public function __construct(Application $app)
    {
        parent::__construct($app);
        try {
            $reflector = new ReflectionClass(get_class($this));
        } catch (\ReflectionException $e) {
            abort(500);
        }
        $this->path = dirname($reflector->getFileName());
        $packages = explode('/', Str::afterLast(str_replace('\\', '/', $this->path), 'vendor/'));
        $this->package = $packages[0].'/'.$packages[1];
        $this->namespace = $reflector->getNamespaceName();
        $this->moduleName = class_basename($this->namespace);
        unset($reflector);
    }

    public function boot()
    {
        config(["modules.{$this->namespace}" => [
            'name'      => $this->moduleName,
            'path'      => $this->path,
            'package'   => $this->package,
            'namespace' => $this->namespace
        ]]);

        if (File::exists($this->path('routes/web.php'))) $this->registerRoute();
        if (File::exists($this->path('routes/admin.php'))) $this->registerRouteAdmin();
        if (File::exists($this->path('routes/api.php'))) $this->registerRouteApi();
        if (File::isDirectory($this->path('Languages'))) $this->registerTranslate();
        if (File::isDirectory($this->path('Views'))) $this->registerView();
        if (File::exists($this->path('helpers.php'))) $this->registerHelper();
        if (File::exists($this->path('config.php'))) $this->registerConfig();
        if (File::isDirectory($this->path('Migrations'))) $this->registerMigration();
        if (isset($this->casts)) $this->registerCasts($this->casts);
        if (isset($this->components)) $this->registerComponents($this->components, strtolower($this->moduleName));
        if (isset($this->permissions)) $this->registerPermissions($this->permissions, strtolower($this->moduleName));
        if (isset($this->adminMenus) || isset($this->appendAdminMenus)) $this->registerAdminMenus(strtolower($this->moduleName));
        if (isset($this->notifications)) $this->registerNotifications($this->notifications);
        if (isset($this->widgets)) $this->registerWidgets($this->widgets);
    }

    private function registerRouteAdmin() {
        Route::middleware(['web', 'auth:employee'])
            ->namespace($this->namespace('Controllers\Admin'))
            ->prefix(config('app.admin_prefix'))
            ->name('admin.')
            ->group($this->path('routes/admin.php'));
    }

    private function registerRouteApi() {
        Route::middleware('api')
            ->namespace($this->namespace('Controllers\Api'))
            ->prefix('api')
            ->name('api.')
            ->group($this->path('routes/api.php'));
    }

    private function registerRoute() {
        Route::middleware('web')
            ->namespace($this->namespace('Controllers'))
            ->group($this->path('routes/web.php'));
    }

    private function registerHelper($file = 'helpers.php') {
        try {
            require_once ($this->path($file));
        } catch (\Exception $e) {

        }
    }

    private function registerTranslate($path = 'Languages', $key = false) {
        $this->loadTranslationsFrom($this->path($path), $key?:$this->moduleName);
        $this->loadJsonTranslationsFrom($this->path($path));
    }

    private function registerConfig($file = 'config.php', $key = false) {
        $this->mergeConfigFrom($this->path($file), $key?:$this->moduleName);
    }

    private function registerView($path = 'Views', $key = false) {
        $this->loadViewsFrom($this->path($path), $key?:$this->moduleName);
    }

    private function registerComponents($components, $key = false) {
        $this->loadViewComponentsAs($key?:$this->moduleName, $components);
    }

    private function registerPermissions($permissions, $key = false) {

        if (! ($this->app instanceof CachesConfiguration && $this->app->configurationIsCached())) {
            $config = $this->app->make('config');

            $config->set('permission.modules.'.($key?:$this->moduleName), $permissions);
        }
    }

    private function registerAdminMenus($key = false) {

        if (isset($this->adminMenus)) {
            Squirrel::addAdminMenu([
                $key?:$this->moduleName => $this->adminMenus
            ]);
        }
        if (isset($this->appendAdminMenus)) {
            foreach ($this->appendAdminMenus as $parent => $menu) {
                Squirrel::addAdminMenu($menu, $parent);
            }
        }
    }

    private function registerMigration($path = 'Migrations') {
        $this->loadMigrationsFrom( $this->path($path));
    }

    private function registerCasts($casts) {
        $_casts = $this->app['config']->get('app.casts');
        $this->app['config']->set('app.casts', array_merge((array)$_casts, $casts));
        unset($_casts);
        unset($casts);
    }

    private function registerNotifications($notifications) {
        foreach ($notifications as $notifySetting) {
            $for = $notifySetting['for'];
            $key = $notifySetting['key'];
            unset($notifySetting['for']);
            unset($notifySetting['key']);
            $this->app['config']->set("notify.{$for}.{$key}", $notifySetting);
        }
    }

    private function registerWidgets($widget, $action = null) {
        Widget::register($widget, $action);
    }

    protected function path($file) {
        $file = ltrim($file, '/');
        return "{$this->path}/{$file}";
    }

    protected function namespace($name) {
        $name = ltrim($name, '\\');
        return "{$this->namespace}\\{$name}";
    }
}
